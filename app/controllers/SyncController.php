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

        exec(sprintf("%s > %s 2>&1 & echo $! >> %s", $cmd, $outputfile, $pidfile));

        return $this->respond('{"message": "Syncing for Hangouts.json has begun."}');
        
    }

    /**
     * Check how far along we are in the process.
     */
    public function check() {

    }

}
