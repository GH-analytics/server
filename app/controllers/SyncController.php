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

        exec("php $base/artisan sync-hangouts $file > /dev/null 2>&1");

        return $this->respond('{"message": "Syncing for Hangouts.json has begun."}');
        
    }

    /**
     * Check how far along we are in the process.
     */
    public function check() {

    }

}
