<?php if ( photob_fs()->is__premium_only() ) : ?>
<fieldset id="pb-source-settings" class="serialize">
    <h3><?php _e('Post settings', 'photoblocks') ?></h3>    
    <div class="field">
        <?php $field = $this->settings->fields["gallery"]["General"]["fields"]["source_post_ids"] ?>
        <?php include $path . "partials/field-type/" . $field["type"]  . ".php" ?>
    </div>
    <div class="field">
        <?php $field = $this->settings->fields["gallery"]["General"]["fields"]["source_post_types"] ?>
        <?php include $path . "partials/field-type/" . $field["type"]  . ".php" ?>
    </div> 
    <div class="field checkboxes js-checkbox-list" data-field="source_post_taxonomies">   
    <?php foreach(get_taxonomies(array("publicly_queryable" => true), "objects") as $taxonomy => $t) : ?>
    
        <?php //$field = $this->settings->fields["gallery"]["General"]["fields"]["source_post_taxonomies"] ?>
        <?php //include $path . "partials/field-type/" . $field["type"]  . ".php" ?>        
        <?php $items = get_terms($taxonomy, array("hide_empty" => false)) ?>
        <?php if(count($items) > 0) : ?>
        <?php //print_r($items); ?>        
            <h4><?php echo $t->label ?></h4>
            <?php $idx = 0; ?>
            <?php foreach($items as $c) : ?>
                <span class="tax-item">
                    <input class="js-checkbox" id="post-tax-<?php _e($c->term_id) ?>" type="checkbox" value="<?php _e($t->name) ?>-<?php _e($c->term_id) ?>">
                    <label for="post-tax-<?php _e($c->term_id) ?>"><?php _e($c->name) ?></label>
                </span> 
            <?php $idx++ ?>
        <?php endforeach ?>
        <?php endif ?>        
    <?php endforeach ?>
    <input type="hidden" class="js-serialize js-serialize-checkboxes" name="source_post_taxonomies" value="">
    </div>
    <a href="#" onclick="PhotoBlocks.updateSource()" title="<?php _e('Done', 'photoblocks') ?>" class="button close-drawer" tabindex="-1"><?php _e('Done', 'photoblocks') ?></a>
</fieldset>
<?php endif ?>