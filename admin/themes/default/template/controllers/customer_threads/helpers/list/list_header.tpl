{*
* ___COPY__RIGHT___
*}

{extends file="helpers/list/list_header.tpl"}

{block name="override_header"}

	<div id="CustomerThreadContacts">

		{assign var=nb_categories value=count($categories)}
		
		{foreach $categories as $key => $val}

			{assign var=total_thread value=0}
			{assign var=id_customer_thread value=0}

			{foreach $contacts as $tmp => $tmp2}
				{if $val.id_contact == $tmp2.id_contact}

					{assign var=total_thread value=$tmp2.total}
					{assign var=id_customer_thread value=$tmp2.id_customer_thread}

				{/if}
			{/foreach}

			<div class="blocSAV">

					<h3>{$val.name}</h3>

					{if $nb_categories < 6}
						<p>{$val.description}</p>
					{/if}

					{if $total_thread == 0}
						<span class="message-mail">{l s='No new messages'}</span>
					{else}
						<a href="{$currentIndex}&token={$token}&id_customer_thread={$id_customer_thread}&viewcustomer_thread" class="button">
							{$total_thread} 
							{if $total_thread > 1}{l s='new messages'}{else}{l s='new message'}{/if}
						</a>
					{/if}
			</div>
		{/foreach}

		<div id="MeaningStatus" class="blocSAV">
			<h3>&nbsp;{l s='Meaning of status'}</h3>
			<ul>
				<li><img src="../img/admin/status_green.png" alt="{l s='Open'}">{l s='Open'}</li>
				<li><img src="../img/admin/status_red.png" alt="{l s='Closed'}">{l s='Closed'}</li>
				<li><img src="../img/admin/status_orange.png" alt="{l s='Pending 1'}">{l s='Pending 1'}</li>
				<li><img src="../img/admin/status_orange.png" alt="{l s='Pending 2'}">{l s='Pending 2'}</li>
			</ul>
		</div>
	
		<div id="CustomerService">
			<table ccellspacing="0" cellpadding="0" class="table">
				<thead>
					<tr>
						<th colspan="2">{l s='Customer service'} : {l s='Statistics'}</th>
					</tr>
				</thead>
				<tbody>
					{assign var=count value=0}
					{foreach $params as $key => $val}
						{assign var=count value=$count+1}
						<tr {if $count % 2 == 0}class="alt_row"{/if}>
							<td>{$key}</td>
							<td><span>{$val}</span></td>
						</tr>
					{/foreach}
				</tbody>
			</table>
		</div>

	</div>

	<p class="clear">&nbsp;</p>

{/block}