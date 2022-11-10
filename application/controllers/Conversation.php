<?php 
    
/** @noinspection PhpUnused */
/** @noinspection SpellCheckingInspection */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property IUserModel $user_model
 * @property IUserActivityModel $user_activity_model
 * @property CI_Output $output
 */
class Conversation extends Controller
{
    
    function get_conversations()
    {
        $parameters = (array) $this->getRawParameters();
        $response = array();
        
        if (array_key_exists("uid", $parameters)) {
            $user_exists = $this->user_model->getById($parameters["uid"]);
            
            if ($user_exists) {
                $all_convos = $this->user_activity_model->getByUId($user_exists->id);
                if (sizeof($all_convos) > 0) {
                    $i = 0;
                    foreach ($all_convos as $row) {
                        $row = (array) $row;
                        $response[$i]["datetime"] = $row["datetime"];
                        $response[$i]["conversation"][] = array(
                            "id"          => $row["id"],
                            "messageType" => $row["message_from"],
                            "value"       => $row["message_text"],
                            "timestamp"   => intval($row["timestamp"]),
                        );
                        
                        $i++;
                    }
                }
            }
        }

        $filteredResponse = array_map(function ($r) {
            return $r['conversation'][0];
        }, $response);
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'code' => 200,
                'payload' => $filteredResponse
            ), JSON_UNESCAPED_UNICODE))
            ->_display();
    }
}