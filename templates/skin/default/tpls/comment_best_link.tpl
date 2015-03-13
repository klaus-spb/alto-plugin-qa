{strip}
	{if $oComment->getTargetType()=='topic' && $oComment->isDeletable() && in_array($oComment->getTarget()->getType(), Config::Get('plugin.qa.allow_topic_type')) }
		<li>
			<a href="#"
			   class="link link-blue-red link-clear comment-reply"
			   onclick="ls.comments.setbest('{$oComment->getId()}', '{$oComment->getTargetId()}'); return false;">
				{if $oComment->getTarget()->getBestCommentId() == $oComment->getCommentId()}{$aLang.plugin.qa.unsetbest}{else}{$aLang.plugin.qa.setbest}{/if}  
			</a>
		</li>
	{/if} 
{/strip}