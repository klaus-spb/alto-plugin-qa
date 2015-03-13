{if $oTopic->getBestComment()}
<div>
	<b>Правильный ответ</b>
	<blockquote>
		{$oTopic->getBestComment()->getText()}
	</blockquote>
</div>
{/if}