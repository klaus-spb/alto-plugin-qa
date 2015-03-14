{strip}
	{if $oComment->isBestable() && $oComment->getTarget()->getIsAllowBestComment()}
		<li>
			<a href="#"
			   class="link link-blue-red link-clear comment-reply" id="set_best_comment_id_{$oComment->getId()}"
			   onclick="ls.comments.setbest(this, '{$oComment->getId()}'); return false;">
				{if $oComment->getTarget()->getBestCommentId() == $oComment->getCommentId()}{$aLang.plugin.qa.unsetbest}{else}{$aLang.plugin.qa.setbest}{/if}  
			</a>
		</li>
	{/if} 
{/strip}