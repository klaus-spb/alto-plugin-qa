<?php

/* ---------------------------------------------------------------------------
 * @Project: Alto CMS
 * @Plugin Name: QA
 * @Author: Klaus
 * @License: GNU GPL v2 & MIT
 *----------------------------------------------------------------------------
 */

class PluginQa_HookQa extends Hook
{

    /*
     * Регистрация событий на хуки
     */
    public function RegisterHook()
    {

        $this->AddHook('template_topic_content_end', 'TopicShow');
        $this->AddHook('template_comment_action', 'CommentLink');

    }

    public function CommentLink($aVars)
    {

        $this->Viewer_Assign('oComment', $aVars['comment']);
        return $this->Viewer_Fetch(Plugin::GetTemplateDir(__CLASS__) . 'tpls/comment_best_link.tpl');

    }

    public function TopicShow($aVars)
    {

        $this->Viewer_Assign('oTopic', $aVars['topic']);
        return $this->Viewer_Fetch(Plugin::GetTemplateDir(__CLASS__) . 'tpls/best_comment.tpl');

    }
}

// EOF
