<?php

class SyncController extends ApiController {

    /**
     * $id passed in is related to the id in the mysql database.
     *
     * @param $id
     * @return type
     */
    public function sync($id) {

        $upload = Upload::whereRaw('user_id = ' . Session::get('id') . ' and id = ' . $id)->first();

        $file = $upload->filename;

        $base = base_path();

        $cmd = "php $base/artisan sync-hangouts $file";

        $outputfile = "/dev/null";

        $pidfile = "/tmp/check.pid";

        // Start command but don't wait for this to finish!
        exec(sprintf("%s > %s 2>&1 & echo $! >> %s", $cmd, $outputfile, $pidfile));

        return $this->respond('{"message": "Syncing for Hangouts.json has begun."}');
        
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

}
