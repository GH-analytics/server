<?php

class ReportingController extends ApiController {

    /**
     * Get the top 10 most used words over a period of time.
     *
     * @param $id
     */
    public function userWordCloud($participant_id, $start_date = null, $end_date = null) {
        // Get all participant data specified.
        $messages = Message::where('participant_id', '=', $participant_id)->get();
        
        if(is_object($messages)) {
            foreach($messages->toArray() as $message) {
                dd($message['message']);
            }
        }
    }

}
