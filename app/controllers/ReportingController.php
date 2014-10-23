<?php

class ReportingController extends ApiController {

    /**
     * Get the top 10 most used words over a period of time.
     *
     * @param $id
     */
    public function userWordCloud($participant_id, $start_date = null, $end_date = null) {
        set_time_limit(200);
        
        $stats = []; // make an empty array to store data in.
        $skip = 0; // How many rows to skip before getting new data
        $take = 1000; // How many to get at a time
        $messages = Message::where('participant_id', '=', $participant_id)->take($take)->lists('message');

        if(count($messages)) {
            // Loop till we have gone through all the messages.
            while(count($messages)) {
                // Loop over each message returned.
                foreach ($messages as $message) {
                    // Loop over each word in each messages
                    foreach(explode(' ', $message) as $word) {
                        if(!isset($stats[$word])) $stats[$word] = 1;
                        else $stats[$word]++;
                    }
                }

                // Increment the data we would like to grab.
                $skip += 1000;
                $take += 1000;
                $messages = Message::where('participant_id', '=', $participant_id)->skip($skip)->take($take)->get();
            }

            arsort($stats);
            dd($stats);
        } else {
            return $this->respondConflict("No messages for this user");
        }
    }

}
