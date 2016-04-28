{* $Id: register-pass.tpl 58201 2016-04-06 14:46:22Z jonnybradley $ *}
{if $prefs.user_register_prettytracker eq 'y' and $prefs.user_register_prettytracker_tpl}
	<input id='pass1' type="password" name="pass" onkeypress="regCapsLock(event)" class="form-control" >
	&nbsp;<strong class='mandatory_star text-danger tips' title=":{tr}This field is mandatory{/tr}">*</strong>
{else}
	{if !isset($openid_associate) || $openid_associate neq 'y'}
		<div class="form-group">
			<label class="col-sm-4 control-label" for="pass1">{tr}Password{/tr} {if $trackerEditFormId}<span class='text-danger tips' title=":{tr}This field is manadatory{/tr}">*</span>{/if}</label>
			<div class="col-sm-8">
				<input
					class="form-control"
					id='pass1'
					type="password"
					name="pass"
					value="{if !empty($smarty.post.pass)}{$smarty.post.pass}{/if}"
				>
				<div style="margin-left:5px;">
					<div id="mypassword_text">{icon name='ok' istyle='display:none'}{icon name='error' istyle='display:none' } <span id="mypassword_text_inner"></span></div>
					<div id="mypassword_bar" style="font-size: 5px; height: 2px; width: 0px;"></div>
				</div>
				{if $prefs.feature_jquery_validation neq 'y'}
					<div style="margin-top:5px">
						{include file='password_help.tpl'}
					</div>
				{/if}
			</div>
		</div>
	{/if}
{/if}
