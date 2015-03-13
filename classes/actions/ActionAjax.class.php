<?php
/* ---------------------------------------------------------------------------
 * @Project: Alto CMS
 * @Plugin Name: Voter
 * @Author: Klaus
 * @License: GNU GPL v2 & MIT
 *----------------------------------------------------------------------------
 */
 
class PluginQa_ActionAjax extends PluginQa_Inherits_ActionAjax {	
	
	
	public function Init() {
		parent::Init();
		$this->oUserCurrent=$this->User_GetUserCurrent();
	}
	
	protected function RegisterEvent() {	
		parent::RegisterEvent();
		$this->AddEventPreg('/^setbestcomment$/i', 'EventSetBestComment');
	}
	 

	protected function EventSetBestComment() {

		if(!$this->oUserCurrent){
			$this->Message_AddErrorSingle($this->Lang_Get('need_authorization'), $this->Lang_Get('error'));
			return;
		}

		if (func_check(getRequest('commentId',null,'post'),'id',1,11))$commentId=getRequest('commentId',null,'post');
		
		if (!($oComment=$this->Comment_GetCommentById($commentId))) {
			$this->Message_AddErrorSingle($this->Lang_Get('system_error'), $this->Lang_Get('error'));
			return;
		} 
		if($oComment->getTargetType()=='topic' && in_array($oComment->getTarget()->getType(), Config::Get('plugin.qa.allow_topic_type')) ){
		
			$oTopic = $this->Topic_GetTopicById($oComment->getTargetId());
			
			if($oComment->getCommentId()==$oComment->getTarget()->getBestCommentId()){
				
				$oTopic->setBestCommentId(0);
				$this->Message_AddNoticeSingle('Комментарий больше не является правильным ответом',  $this->Lang_Get('attention'));
			}else{
				$oTopic->setBestCommentId($oComment->getCommentId());
				$this->Message_AddNoticeSingle('Комментарий назначен правильным ответом',  $this->Lang_Get('attention'));
			}
			$this->Topic_UpdateTopic($oTopic);
			
		}
		
	}
	
}

?>