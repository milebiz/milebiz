{*
* ___COPY__RIGHT___
*}

		{if !$content_only}
				</div>

<!-- Right -->
				<div id="right_column" class="column grid_2 omega">
					{$HOOK_RIGHT_COLUMN}
				</div>
			</div>

<!-- Footer -->
			<div id="footer" class="grid_9 alpha omega clearfix">
				{$HOOK_FOOTER}
				{if $PS_ALLOW_MOBILE_DEVICE}
					<p class="center clearBoth"><a href="{$link->getPageLink('index', true)}?mobile_theme_ok">{l s='浏览移动版'}</a></p>
				{/if}
			</div>
		</div>
	{/if}
	</body>
</html>
