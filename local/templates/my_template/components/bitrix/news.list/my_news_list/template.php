<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-list">
	<div id="barba-wrapper">
		<div class="article-list">
			<?foreach($arResult["ITEMS"] as $arItem):?>
					<a class="article-item article-list__item" href="for-individuals.html" data-anim="anim-3">
						<div class="article-item__background">
							<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem['NAME'];?>"/>
						</div>
						<div class="article-item__wrapper">
							<div class="article-item__title">
								<?=$arItem['NAME'];?>
							</div>
							<div class="article-item__content">
								<?=$arItem['DETAIL_TEXT'];?>
							</div>
						</div>
					</a>
			<?endforeach;?>
		</div>
	</div>
</div>
