{**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������Ƽ����޹�˾��
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 *}

<ul id="multishop-tree">
</ul>

<script type="text/javascript">
function check_selected_tree_node(d)
{
	{if isset($selected_tree_id)}
		$.each(d, function(k, v)
		{
			if (v.attr.id == '{$selected_tree_id}')
			{
				setTimeout(function()
				{
					$('#{$selected_tree_id}').children('a').addClass('selected');
				}, 100);
			}

			if (v.children)
			{
				check_selected_tree_node(v.children);
			}
		});
	{/if}
}

function customMenu(node)
{
	var node_id = node.attr('id');

	// Click on a group
	if (new RegExp(/^tree-group-[0-9]+$/).exec(node_id))
	{
		var id = node_id.substr(11);
		return {
			"edit_shop_group" : {
				"separator_before"	: false,
				"separator_after"	: true,
				"label"				: "{l s='Edit this shop group'}",
				"icon"				: "../img/admin/edit.gif",
				"action"			: function (obj){
					location.href = '{$link->getAdminLink('AdminShopGroup')}&updateshop_group&id_shop_group='+id;
				}
			},
			"add_shop_group" : {
				"separator_before"	: false,
				"separator_after"	: false,
				"label"				: "{l s='Add new shop group'}",
				"icon"				: "../img/admin/add.gif",
				"action"			: function (obj){
					location.href = '{$link->getAdminLink('AdminShopGroup')}&addshop_group';
				}
			},
			"add_shop" : {
				"separator_before"	: false,
				"separator_after"	: true,
				"label"				: "{l s='Add new shop'}",
				"icon"				: "../img/admin/add.gif",
				"action"			: function (obj){
					location.href = '{$link->getAdminLink('AdminShop')}&addshop&id_shop_group='+id;
				}
			}
		};
	}
	// Click on a shop
	else if (new RegExp(/^tree-shop-[0-9]+$/).exec(node_id))
	{
		var id = node_id.substr(10);
		var id_parent = node.parent().parent().attr('id').substr(11);
		return {
			"edit_shop" : {
				"separator_before"	: false,
				"separator_after"	: true,
				"label"				: "{l s='Edit this shop'}",
				"icon"				: "../img/admin/edit.gif",
				"action"			: function (obj){
					location.href = '{$link->getAdminLink('AdminShop')}&updateshop&id_shop='+id;
				}
			},
			"add_shop" : {
				"separator_before"	: false,
				"separator_after"	: false,
				"label"				: "{l s='Add new shop'}",
				"icon"				: "../img/admin/add.gif",
				"action"			: function (obj){
					location.href = '{$link->getAdminLink('AdminShop')}&addshop&id_shop_group='+id_parent;
				}
			},
			"add_url" : {
				"separator_before"	: false,
				"separator_after"	: true,
				"label"				: "{l s='Add new URL'}",
				"icon"				: "../img/admin/add.gif",
				"action"			: function (obj){
					location.href = '{$link->getAdminLink('AdminShopUrl')}&addshop_url&id_shop='+id;
				}
			}
		};
	}
	// Click on an URL
	else if (new RegExp(/^tree-url-[0-9]+$/).exec(node_id))
	{
		var id = node_id.substr(9);
		var id_parent = node.parent().parent().attr('id').substr(10);
		return {
			"edit_url" : {
				"separator_before"	: false,
				"separator_after"	: true,
				"label"				: "{l s='Edit this URL'}",
				"icon"				: "../img/admin/edit.gif",
				"action"			: function (obj){
					location.href = '{$link->getAdminLink('AdminShopUrl')}&updateshop_url&id_shop_url='+id;
				}
			},
			"add_url" : {
				"separator_before"	: false,
				"separator_after"	: true,
				"label"				: "{l s='Add new URL'}",
				"icon"				: "../img/admin/add.gif",
				"action"			: function (obj){
					location.href = '{$link->getAdminLink('AdminShopUrl')}&addshop_url&id_shop='+id_parent;
				}
			}
		};
	}
	// Click on root node
	else
	{
		return {
			"add_shop_group" : {
				"separator_before"	: false,
				"separator_after"	: false,
				"label"				: "{l s='Add new shop group'}",
				"icon"				: "../img/admin/add.gif",
				"action"			: function (obj){
					location.href = '{$link->getAdminLink('AdminShopGroup')}&addshop_group';
				}
			},
			"add_shop" : {
				"separator_before"	: false,
				"separator_after"	: true,
				"label"				: "{l s='Add new shop'}",
				"icon"				: "../img/admin/add.gif",
				"action"			: function (obj){
					location.href = '{$link->getAdminLink('AdminShop')}&addshop';
				}
			},
			"add_url" : {
				"separator_before"	: false,
				"separator_after"	: true,
				"label"				: "{l s='Add new URL'}",
				"icon"				: "../img/admin/add.gif",
				"action"			: function (obj){
					location.href = '{$link->getAdminLink('AdminShopUrl')}&addshop_url';
				}
			}
		};
	}
}

$("#multishop-tree").jstree({
	'plugins': ["themes","json_data","cookies","contextmenu"],
	'json_data': {
		'ajax': {
			'url': "{$link->getAdminLink('AdminShop')}",
			'data': function(n)
			{
				return {
					'ajax': 'true',
					'action': 'tree',
					'id': n.attr ? n.attr('id').replace(/tree-(group|shop|url)-/i, '') : '0'
				};
			},
			'success': check_selected_tree_node
		}
	},
	'cookies': {
		'save_selected': false
	},
	'core': {
		'html_titles': true,
		'animation': 300
	},
	'contextmenu': {
		items : customMenu
	},
	'themes': {
		'theme': 'classic'
	}
});
</script>