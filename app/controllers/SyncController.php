<?php

class SyncController extends ApiController {

    /**
     * $id passed in is related to the id in the mysql database.
     *
     * @param $id
     * @return type
     */
    public function sync($id) {
        // Check that we are not already running this process.
        if($this->pid()) return $this->respond('{"message": "Sync already in progress"}');

        // Clean all tables.
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('conversation_participant')->delete();
        DB::table('participants')->delete();
        DB::table('messages')->delete();
        DB::table('conversations')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $upload = Upload::whereRaw('user_id = ' . Session::get('id') . ' and id = ' . $id)->first();

        if(is_object($upload)){
            $file = $upload->filename;

            $base = base_path();

            $cmd = "php $base/artisan sync-hangouts $file";

            $outputfile = "/dev/null";

            $pidfile = "/tmp/check.pid";

            // Start command but don't wait for this to finish!
            try{
                unlink($pidfile);
            }catch (Exception $e){}

            exec(sprintf("%s > %s 2>&1 & echo $! >> %s", $cmd, $outputfile, $pidfile));

            return $this->respond('{"message": "Syncing for Hangouts.json has begun."}');
        } else {
            return $this->respond('{"message": "Could not find a record for the data you entered."}');
        }
        
        
    }

    /**
     * Check how far along we are in the process.
     * Or at least see how many things have been pushed
     * up to the database... likely via messages.
     */
    public function check() {

        $count = DB::table('messages')->count();
        return $this->respond('{messages: "' . $count . '"}');

    }

    /**
     * See if the PID saved to check.pid is still
     * running or has stopped.
     *
     * @return type
     */
    public function checkpid() {

        if($this->pid()){
            return $this->respond('{"message": "Process is running..."}');
        }

        return $this->respond('{"message": "Process has stopped..."}');

    }

    private function pid() {

        try{
            $file = file_get_contents('/tmp/check.pid');
            $result = shell_exec(sprintf("ps %d", $file));
            if( count(preg_split("/\n/", $result)) > 2){
                return true;
            }
        }catch(Exception $e){}

        return false;
    }

}
