<?php
class PluginQa_ModuleTopic_EntityTopic extends PluginQa_Inherit_ModuleTopic_EntityTopic {
	
	public function setBestCommentId($nCommentId) {
		$this->setExtraValue('best_comment', $nCommentId);
	}
	public function getBestCommentId() {
		return $this->getExtraValue('best_comment');
	}
	public function getBestComment() {
		if($this->getBestCommentId()){
			if (is_numeric($this->getBestCommentId())) {
				$aComments = $this->Comment_GetCommentsAdditionalData($this->getBestCommentId(), array('user' => array()));
				if (isset($aComments[$this->getBestCommentId()])) {
					return $aComments[$this->getBestCommentId()];
				}
			}
		}
        return null;
    }
	
	public function getIsAllowBestComment() {
        if (in_array($this->getType(), Config::Get('plugin.qa.allow_topic_type'))) {
            return true;
        }
        return false;
    }
}

?>