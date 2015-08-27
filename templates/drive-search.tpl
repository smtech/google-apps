{extends file="page.tpl"}

{block name="header"}{/block}

{block name="content"}

	{assign var="search" value=$search|default:'Search'}
	{assign var="title" value=$title|default:$search}
	{assign var="directions" value=$directions|default:false}
	{assign var="target" value=$target|default:'_top'}
	{assign var="placeholder" value=$placeholder|default:'Enter your search query here&hellip;'}
	{assign var="browseUrl" value=$browseUrl|default:false}
	{assign var="browseText" value=$browseText|default:'Browse'}
	{assign var="browseTarget" value=$browseTarget|default:$target}

	<div class="container">
		<form
			action="{$smarty.server.PHP_SELF}"
			method="get"
			{if $target}
				target="{$target}"
			{/if}
		>
			{foreach $formHidden as $name => $value}
				<input type="hidden" name="{$name}" value="{$value}" />
			{/foreach}
			<div class="form-group">
				<label class="control-label" for="query">{$title}</label>
					<div class="input-group">
						<input
							type="text"
							class="form-control"
							name="query"
							id="query"
							placeholder="{$placeholder}"
						/>
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit">{$search}</button>
							{if $browseUrl}
								<a
									class="btn btn-default"
									href="{$browseUrl}"
									{if $browseTarget}
										target="{$browseTarget}"
									{/if}
								>
									{$browseText}
								</a>
							{/if}
						</span>
					</div>
					{if $directions}
						<p span="help-block">{$directions}</p>
					{/if}
				</div>
		</form>
	</div>

{/block}

{block name="footer"}{/block}