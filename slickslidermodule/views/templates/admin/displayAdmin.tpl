
<div class="panel col-lg-12">
  <form action="index.php?controller=AdminSlickSliderModule&token={$token}" method="post"  enctype="multipart/form-data">
    {if !empty($SlickSliderCollection)}
      {foreach from=$SlickSliderCollection key=k item=item}      
        <div class="col-md-12" style="position: relative; border: 1px solid #c7d6db; border-radius: 15px; margin: 20px 0;padding: 20px;">
            <strong style="font-size: 22px; float: left;width: 100%;margin-bottom: 30px;"> 
                Slide nr. {$k} 
            </strong>
            <a href="index.php?controller=AdminSlickSliderModule&token={$token}&slickslider[delete]={$item->id}" class="btn btn-large btn-danger" style="float: right;color: white;position: absolute; top: 20px; right: 20px;z-index:1;"> Delete slide </a>
            <input type="submit" value="save" name="slickslider[submit]" class="btn btn-primary btn-large" style="position:absolute;right: 20px; bottom: 20px;padding: 10px 20px">
            <div class="col-md-6">
                Slide title <br/>
                <input type="text" name="slickslider[{$k}][title]" value="{$item->title}"/><br/>
                Slide subtitle <br/>
                <textarea name="slickslider[{$k}][subtitle]">{$item->subtitle}</textarea><br/>
                Slide button text <br/> 
                <input type="text" name="slickslider[{$k}][button_text]" value="{$item->button_text}"/><br/>
                Slide button uri <br/>
                <input type="text" name="slickslider[{$k}][button_uri]" value="{$item->button_uri}" /><br/>
            </div>
            <div class="col-md-6">
                <div style="max-width: 580px; width: 100%; margin: 0 auto;">
                    <img src="{$item->image_src}" style="max-width: 100%; float: left;"/>
                    <div class="image" style="float: left; width: 100%; margin: 30px;">
                        Slide image <br/>
                        <input type="file" name="slickslider[{$k}][image_src]" />
                    </div>
                </div>
            </div>
            <input type="hidden" name="slickslider[{$k}][id]" value="{$item->id}"/>
        </div>
    {/foreach}
    {/if}
        <div class="col-md-12" style="position: relative; border: 1px solid #c7d6db; border-radius: 15px;margin: 20px 0;padding: 20px;">
            <strong style="font-size: 22px; float: left;width: 100%;margin-bottom: 30px;"> Add new slide </strong> 
            <input type="submit" value="Add new Slide" name="slicksliderAddNew[submit]" class="btn btn-primary btn-large" style="position:absolute;right: 0; bottom: 0;padding: 10px 20px;right: 20px; bottom: 20px;">
            <div class="col-md-6">
                Slide title <br/>
                <input type="text" name="slicksliderAddNew[title]" /><br/>
                Slide subtitle <br/>
                <textarea name="slicksliderAddNew[subtitle]"> </textarea><br/>
                Slide button text <br/>
                <input type="text" name="slicksliderAddNew[button_text]" /><br/>
                Slide button uri <br/>
                <input type="text" name="slicksliderAddNew[button_uri]" /><br/>
            </div>
            <div class="col-md-6">
                Slide image <br/>
                <input type="file" name="slicksliderAddNew[image_src]" />
            </div>
        </div>
</div>
