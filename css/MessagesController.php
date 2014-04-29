<?php

App::uses('CakeEmail', 'Network/Email');

class MessagesController extends AppController {

    public $name = 'Messages';

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Message', 'Profile', 'TabletUserProfile');

    /**
     * Used to display all Message by user
     *
     * @access public
     * @param integer $userId user id of user
     * @return array
     */
    public function index() {
        //$userid = $this->UserAuth->getUserId();
        $userid = $this->requestAction('/ManageUsers/userRole');
    }

    /**
     * Used to add new message by user
     *
     * @access public
     * @param integer $userId user id of user
     * @return array
     */
    public function add() {
        //$userid = $this->UserAuth->getUserId();
        $userid = $this->requestAction('/ManageUsers/userRole');

        if ($this->request->isPost()) {
            $status = 1;
            $msg = $this->request->data['Message']['tx_description'];
            $user_profiles = $this->request->data['Message']['user_profiles'];
            $profiles = $this->request->data['Message']['profiles'];
            $can_updated = 0;
            if (isset($this->request->data['can_updated']) && $this->request->data['can_updated'] == 1)
                $can_updated = 1;

            if ($user_profiles == 0) {
                $profiles = 0;
            }

            $da_scheduled = $this->request->data['Message']['da_scheduled'];

            if (!empty($da_scheduled)) {
                $status = 0;
            }
            /* $subj = "test salesipad ";
              $to = "apa.narola@narolainfotech.com";

              $email = new CakeEmail('smtp');
              $email->emailFormat('html');
              $email->to($to);
              $email->subject($subj);
              try {
              $result = $email->send($msg);
              } catch (Exception $ex) {
              // we could not send the email, ignore it
              $result = "Could not send confirmation email to user-" . $to;
              }
              $this->log($result, LOG_DEBUG); */

            $tablet_user_profiles = array();
            if ($user_profiles == 0) {
                $tablet_user_profiles = $this->TabletUserProfile->find('all', array('conditions' => array('Profile.user_id' => $userid)));
            } else {
                $tablet_user_profiles = $this->TabletUserProfile->find('all', array('conditions' => array('Profile.user_id' => $userid, 'TabletUserProfile.profile_id in (' . $profiles . ')')));
            }
            $final_arr = array();
            if (!empty($tablet_user_profiles)):

                foreach ($tablet_user_profiles as $key => $val):
                    $uid = $val["User"]["id"];
                    if (!array_key_exists($uid, $final_arr)):

                        $final_arr[$uid]["user_id"] = $val["User"]["id"];
                        $final_arr[$uid]["email"] = $val["User"]["email"];
                        $final_arr[$uid]["first_name"] = $val["User"]["first_name"];
                        $final_arr[$uid]["last_name"] = $val["User"]["last_name"];
                        $final_arr[$uid]["tx_device_token"] = $val["User"]["tx_device_token"];
                    endif;
                endforeach;
            endif;

            if (!empty($final_arr) && $msg != "") {
                //flag to on/off mail and push
                $send_mail_flag = 1;
                $send_push_flag = 1;

                $ios_certificate_path = WWW_ROOT . "certificates" . DS . "ck.pem";
                $passphrase = 'password';

                $ctx = stream_context_create();
                //stream_context_set_option($ctx, 'ssl', 'local_cert', VENDORS . 'ck.pem');
                stream_context_set_option($ctx, 'ssl', 'local_cert', $ios_certificate_path);
                stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

                $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

                if (!$fp)
                    echo "Failed to connect : $err $errstr" . PHP_EOL;

                // echo 'Connected to APNS' . PHP_EOL;
                // Create the payload body
                $pnbody['aps'] = array(
                    'alert' => $msg,
                    'sound' => 'default'
                );

                // Encode the payload as JSON
                $payload = json_encode($pnbody);
                $message_sent_status = array();


                $email = new CakeEmail('smtp');

                foreach ($final_arr as $e_key => $e_val):

                    if ($send_mail_flag == 1) {

                        //send email to user
                        $subj = "Notification from venuspresenter";
                        $to = $e_val["email"];
                        $user_id = $e_val["user_id"];
                        $first_name = $e_val["first_name"];
                        $last_name = $e_val["last_name"];
                        $device_token = $e_val["tx_device_token"];

                        $email = new CakeEmail('smtp');
                        $email->emailFormat('both');
                        $email->to($to);
                        $email->subject($subj);
                        $ebody = "<table border='0'>";
                        $ebody .="<tr><td>Hi " . $first_name . ",<br/></td></tr>";
                        $ebody .="<tr><td><p>" . $msg . "</p></td></tr>";
                        $ebody .="<tr><td><br/>Thanks,<br/>" . EMAIL_FROM_NAME . "</td></tr>";
                        $ebody .="</table>";
                        try {
                            $result = $email->send($ebody);
                        } catch (Exception $ex) {
                            $email->to($to);

                            // we could not send the email, ignore it
                            $result = "Could not send confirmation email to user-" . $to;
                        }
                        $this->log($result, LOG_DEBUG);
                    }
                    // send push to user
                    if ($send_push_flag == 1) {
                        if ($device_token != "") {

                            // Build the binary notification
                            $binarymsg = chr(0) . pack('n', 32) . pack('H*', $device_token) . pack('n', strlen($payload)) . $payload;

                            // Send it to the server
                            $result = fwrite($fp, $binarymsg, strlen($binarymsg));

                            if (!$result) {
                                $message_sent_status["user_id"] = $user_id;
                                $message_sent_status["status"] = "failed";
                                $message_sent_status["device_token"] = $device_token;
                            } else {
                                $message_sent_status["user_id"] = $user_id;
                                $message_sent_status["status"] = "success";
                                $message_sent_status["device_token"] = $device_token;
                            }
                        }
                    }

                endforeach;
                //pr($message_sent_status);
            }


            $this->request->data['Message']['user_id'] = $userid;
            $this->request->data['Message']['profile_id'] = $profiles;
            $this->request->data['Message']['can_updated'] = $can_updated;
            $this->request->data['Message']['tx_description'] = $msg;
            $this->request->data['Message']['da_scheduled'] = $da_scheduled;
            $this->request->data['Message']['da_created'] = date("Y-m-d H:i:s");
            $this->request->data['Message']['status'] = $status;

            if ($this->Message->save($this->request->data['Message'])) {
                echo 1;
            } else {
                echo 0;
            }

            exit;
        }
    }
/*
delete message
*/
public function delete($id=null)
{
    if($id != null)
    {
        
        $this->Message->delete($id);
        $this->Session->setFlash('Message deleted successfully.', 'custom_flash_message', array('class' => 'alert alert-success'));
        
    }else{
        $this->Session->setFlash('Invalid message id. please pass valid message id.', 'custom_flash_message', array('class' => 'alert alert-error'));
    }
    $this->redirect('/messages');
    
 }

    /**
     * Used to search message by date by user
     *
     * @access public
     * @param integer $userId user id of user
     * @return array
     */
    public function search() {
        //$userid = $this->UserAuth->getUserId();
        $userid = $this->requestAction('/ManageUsers/userRole');

        if ($this->request->isPost()) {
            $ascdesc = $this->request->data['ascdesc'];
            $adsSearch = $this->request->data['adsSearch'];

            if ($ascdesc == 'undefined') {
                $ascdesc = 'desc';
            }
            if ($adsSearch == 'undefined') {
                $adsSearch = 'da_created';
            }

            if ((!empty($ascdesc)) && (!empty($adsSearch))) {
                $order = 'Message.' . $adsSearch . ' ' . $ascdesc;
            }

            $message = $this->Message->find('all', array('conditions' => array('Message.user_id' => $userid), 'order' => $order));

            $messages = array();
            if (!empty($message)) {
                foreach ($message as $k => $v) {
                    $messages[$k]['Message'] = $v['Message'];
                    $messages[$k]['Profiles'] = $this->Profile->find('all', array('conditions' => array('Profile.id IN(' . $v['Message']['profile_id'] . ')', 'Profile.user_id' => $userid)));
                }
            }

            $this->set(compact('messages', 'ascdesc', 'adsSearch'));
        }
    }

    public function scheduleMessage() {

        $message = $this->Message->find('all', array('conditions' => array('Message.da_scheduled' => date('Y-m-d H:i:s'), 'Message.status' => 0)));

        if (!empty($message)) {
            foreach ($message as $k => $val) {
                $val['Message']['status'] = 1;
                $this->Message->saveAll($val['Message']);
            }
        }

        exit;
    }

}

?>
