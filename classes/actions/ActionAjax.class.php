<?php

/* ---------------------------------------------------------------------------
 * @Project: Alto CMS
 * @Plugin Name: QA
 * @Author: Klaus
 * @License: GNU GPL v2 & MIT
 *----------------------------------------------------------------------------
 */

class PluginQa_ActionAjax extends PluginQa_Inherits_ActionAjax
{


    public function Init()
    {
        parent::Init();
        $this->oUserCurrent = $this->User_GetUserCurrent();
    }

    protected function RegisterEvent()
    {
        parent::RegisterEvent();
        $this->AddEventPreg('/^setbestcomment$/i', 'EventSetBestComment');
    }


    protected function EventSetBestComment()
    {

        if (!$this->oUserCurrent) {
            $this->Message_AddErrorSingle($this->Lang_Get('need_authorization'), $this->Lang_Get('error'));
            return;
        }

        if (func_check(getRequest('commentId', null, 'post'), 'id', 1, 11)) $commentId = getRequest('commentId', null, 'post');

        if (!($oComment = $this->Comment_GetCommentById($commentId))) {
            $this->Message_AddErrorSingle($this->Lang_Get('system_error'), $this->Lang_Get('error'));
            return;
        }
        if (!$oComment->isBestable()) {
            $this->Message_AddErrorSingle($this->Lang_Get('system_error'), $this->Lang_Get('error'));
            return;
        }
        if (!($oComment = $this->Comment_GetCommentById($commentId))) {
            $this->Message_AddErrorSingle($this->Lang_Get('system_error'), $this->Lang_Get('error'));
            return;
        }
        if (!($oTopic = $this->Topic_GetTopicById($oComment->getTargetId()))) {
            $this->Message_AddErrorSingle($this->Lang_Get('system_error'), $this->Lang_Get('error'));
            return;
        }

        $oTopic = $this->Topic_GetTopicById($oComment->getTargetId());

        if ($oComment->isBestable() && $oTopic->getIsAllowBestComment()) {

            if ($oComment->getCommentId() == $oComment->getTarget()->getBestCommentId()) {
                $oTopic->setBestCommentId(0);

                $sMsg = $this->Lang_Get('plugin.qa.comment_unset_best');
                $sTextToggle = $this->Lang_Get('plugin.qa.setbest');
            } else {
                $oTopic->setBestCommentId($oComment->getCommentId());

                $sMsg = $this->Lang_Get('plugin.qa.comment_set_best');
                $sTextToggle = $this->Lang_Get('plugin.qa.unsetbest');
            }
            $this->Topic_UpdateTopic($oTopic);

            $this->Message_AddNoticeSingle($sMsg, $this->Lang_Get('attention'));
            $this->Viewer_AssignAjax('sTextToggle', $sTextToggle);
        }


    }

}

?>