<?php
class PluginQa_ModuleComment_EntityComment extends PluginQa_Inherit_ModuleComment_EntityComment {
	
	public function isBestable() {

        if ($this->getTargetType() != 'talk' && !$this->getDelete() && ($oUser = $this->User_GetUserCurrent())) {
            if ($oUser->isAdministrator()) {
                return true;
            }
            if (($oBlog = $this->getTargetBlog()) && $this->ACL_CheckBlogDeleteComment($oBlog, $oUser)) {
                return true;
            }
			if ($this->getTarget()->getUserId() == $oUser->getUserId()) {
				return true;
			}
        }
        return false;
    }
	
	public function isDeletable() {

        if ($this->getTargetType() != 'talk' && ($oUser = E::ModuleUser()->GetUserCurrent()) && $this->getTarget()->getBestCommentId()!=$this->getId()) {
            if ($oUser->isAdministrator()) {
                return true;
            }
            if (($oBlog = $this->getTargetBlog()) && E::ModuleACL()->CheckBlogDeleteComment($oBlog, $oUser)) {
                return true;
            }
        }
        return false;
    }
	
}

?>