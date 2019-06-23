<?php


namespace app\widgets;


use app\assets\MessageAsset;
use vision\messages\widgets\PrivateMessageWidget;
use Yii;

/**
 * Class Messenger
 * @package app\widgets
 *
 * @property string $head
 * @property string $boxMessages
 * @property string $formInput
 * @property string $listUsers
 */
class Messenger extends PrivateMessageWidget
{

    public $headLabel = 'Нихуя';


    public function run()
    {
        $this->assetJS();
        $this->html = '<div id="' . $this->uniq_id . '" class="main-message-container message-layout clearfix">';
        $this->html .= '<div class="message-north right-column message">';
//        $this->html .= $this->getHead();
        $this->html .= $this->getBoxMessages();
        $this->html .= $this->getListUsers();
        $this->html .= '</div></div>';
        return $this->html;
    }


    protected function getListUsers()
    {
        $users = Yii::$app->user->identity->allUsers;
        $html = '<div class="col-md-2">';
        $html .= '<div class="list_users message-user-list friends-message-layout">';
        $html .= '<div id="scrollbar3">
                            <div class="scrollbar">
                                <div class="track">
                                    <div class="thumb">
                                        <div class="end">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="viewport">
                                <div class="overview" style="top 10px;">';

        foreach ($users as $usr) {
            $username = trim($usr['username']);
            $names = explode(' ', $username);
            $html .= '<div class="contact friends" data-name="' . $username . '" data-user="' . $usr['id'] . '">';

            $html .= '<button class="delete-friend">&times;</button>';

            $html .= '<span class="counter-message" style="display:' . ($usr['cnt_mess'] > 0 ? 'block' : 'none') . '">';
            if ($usr['cnt_mess']) {
                $html .= $usr['cnt_mess'];
            }
            $html .= '</span>';
            $img = Yii::$app->mymessages->createLogo($usr['id']);
            if ($img) {
                $html .= '<div class="friends-block">';
                $html .= $img;
                $html .= '</div>';
            }

            $html .= '<div class="friends-name">';

            $html .= array_reduce($names, function ($pre, $val) {
                return $pre . "<div>$val</div>";
            });
            $html .= "</div></div>";
        }

        $html .= '        </div>
                            </div>
                        </div>
                    </div>';
        $html .= '</div>';
        return $html;
    }


    protected function getBoxMessages()
    {
        $html = '';
        $html .= '<div class="col-md-10">';
        $html .= '<div class="message-thread message-wrapper clearfix">';
        $html .= '<div id="scrollbar1">';
        $html .= '<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>';
        $html .= '<div class="viewport"><div class="overview message-container">';
        $html .= '</div></div></div>';
        $html .= $this->getFormInput();
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }


    protected function getFormInput()
    {
        $html = '<div class="message-south create-message"><form action="#" class="message-form" method="POST">';
        $html .= '<textarea class="textarea-layout" disabled="true" name="input_message"></textarea>';
        $html .= '<input type="hidden" name="message_id_user" value="">';
        $html .= '<button class="send-message" type="submit">' . $this->buttonName . '</button>';
        $html .= '</form></div>';
        return $html;
    }


    protected function getHead()
    {
        $html = '<div class="right-layout">';
        $html .= '<div class="separate"></div>';
        $html .= '<div class="layout-background clearfix">';
        $html .= '<div class="dialogue">' . $this->headLabel . '</div>';
        $html .= '<div class="message-layout-search">';
        $html .= '<form><div class="search">';
        $html .= '<input type="search">';
        $html .= '<input type="submit" disabled="disabled" value="">';
        $html .= '</div></form></div></div></div>';
        return $html;
    }


    protected function assetJS()
    {
        MessageAsset::register($this->view);
        $this->addJs();
    }
}