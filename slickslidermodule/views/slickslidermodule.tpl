{if !empty($SlickSliderModuleData)}
    <section class="product-slider"> 
        <div class="container-small">
            <div class="row">
                <div class="bullets-container"></div>
                <div class="slides">
                    {foreach from=$SlickSliderModuleData key=key item=item}
                        <div>
                            <div class="content-container">
                                <h3 class="slogan"> {$item->title} </h3>
                                <div class="desc-container"> 
                                    <p> 
                                        {$item->subtitle}
                                    </p>
                                </div>
                            </div>
                            <div class="button-container">
                                <a href=" {$item->button_uri}" class="button button-rounded small white"> {$item->button_text} </a>
                            </div>
                            <div class="content-container slider-image">
                                <img src="{$item->image_src}" />
                            </div>
                        </div>
                    {/foreach}
                </div>
            </div>
        </div>
    </section>
{/if}
