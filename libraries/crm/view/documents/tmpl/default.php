<?php
/*------------------------------------------------------------------------
# Cobalt
# ------------------------------------------------------------------------
# @author Cobalt
# @copyright Copyright (C) 2012 cobaltcrm.org All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Website: http://www.cobaltcrm.org
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); ?>

<div class="page-header">
    <h1><?php echo CRMText::_('COBALT_EDIT_DOCUMENTS'); ?></h1>
</div>
<ul class="inline-list">
    <li><span><?php echo CRMText::_('COBALT_SHOW'); ?></span></li>
    <li class="dropdown">
        <a class="dropdown-toggle update-toggle-text" href="javascript:void(0);" data-toggle="dropdown" role="button" href="javascript:void(0);" id="document_assoc_link"><span class="dropdown-label"><?php echo $this->assoc_name; ?></span></a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="document_assoc_link">
            <?php foreach( $this->assoc_names as $title => $text ){
                echo "<li><a class='filter_".$title."' onclick=\"documentAssoc('".$title."')\">".$text."</a></li>";
            }?>
        </ul>
    </li> 
    <li><span><?php echo CRMText::_('COBALT_OWNED_BY'); ?></span></li>
    <li class="dropdown">
        <a class="dropdown-toggle update-toggle-text" href="javascript:void(0);" data-toggle="dropdown" role="button" href="javascript:void(0);" id="document_user_link"><span class="dropdown-label"><?php echo $this->user_name; ?></span></a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="document_user_link">
            <li><a class="filter_user_<?php echo $this->user_id; ?>" onclick="documentUser(<?php echo $this->user_id; ?>)">Me</a></li>
            <?php
                if ( $this->member_role == 'exec' ){
                    if ( count($this->teams) > 0 ){
                        foreach($this->teams as $team){
                             echo "<li><a class='filter_team_".$team['team_id']."' onclick='documentUser(0,".$team['team_id'].")'>".$team['team_name'].CRMText::_('COBALT_TEAM_APPEND')."</a></li>";
                         }
                    }
                }
                if ( $this->member_role != 'basic' ){
            ?>
            <li><a class="filter_user_all" onclick="documentUser('all')"><?php echo CRMText::_('COBALT_ALL_USERS'); ?></a></li>
            <?php } ?>
            <?php foreach($this->users as $key => $user){
                    echo "<li><a class='filter_user_".$user['id']."' onclick='documentUser(".$user['id'].")' >".$user['first_name'].' '.$user['last_name']."</a></li>";
                }
            ?>
        </ul>
    </li>
    <li><span><?php echo CRMText::_('COBALT_THAT_ARE'); ?></span></li>
    <li class="dropdown">
        <a class="dropdown-toggle update-toggle-text" href="javascript:void(0);" data-toggle="dropdown" role="button" href="javascript:void(0);" id="document_type_link"><span class="dropdown-label"><?php echo $this->type_name; ?></span></a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="document_type_link">
            <?php foreach ( $this->type_names as $title => $text ){
                echo "<li><a class='filter_".$title." dropdown_item' onclick=\"documentType('".$title."')\">".$text."</a></li>";                     
            }?>
        </ul>
    </li>
    <li>
        <span><?php echo CRMText::_('COBALT_NAMED'); ?></span>
        <input type="text" class="inputbox" placeholder="<?php echo CRMText::_('COBALT_ANYTHING'); ?>" value="" name="document_name_search" />
    </li>
    <li>
        <div class="ajax_loader"></div>
    </li>
</ul>

<small>
    <span id="documents_matched"></span> <?php echo CRMText::_('COBALT_DOCUMENT_MATCHES'); ?>. <?php echo CRMText::_('COBALT_DOCUMENT_THERE_ARE'); ?> <span id="documents_total"><?php echo CobaltHelperDocument::getTotalDocuments(); ?></span> <?php echo CRMText::_('COBALT_DOCUMENT_IN_YOUR_ACCOUNT'); ?>.
</small>

<table class="table table-striped table-hover">
    <?php echo $this->document_list->render(); ?>
</table>