<?php

use yii\db\Migration;
use yii\db\Schema;

class m150825_220620_add_page_permissions extends Migration
{

    public function up()
    {

        $this->insert('auth_item_group', ['code' => 'pageManagement', 'name' => 'Page Management', 'created_at' => '1440180000', 'updated_at' => '1440180000']);

        $this->insert('auth_item', ['name' => '/admin/page/*', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/page/default/*', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/page/default/bulk-activate', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/page/default/bulk-deactivate', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/page/default/bulk-delete', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/page/default/create', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/page/default/delete', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/page/default/grid-page-size', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/page/default/grid-sort', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/page/default/index', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/page/default/toggle-attribute', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/page/default/update', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => '/admin/page/default/view', 'type' => '3', 'created_at' => '1440180000', 'updated_at' => '1440180000']);

        $this->insert('auth_item', ['name' => 'accessAllPages', 'type' => '2', 'description' => 'Manage other users\' pages', 'group_code' => 'pageManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'createPages', 'type' => '2', 'description' => 'Create pages', 'group_code' => 'pageManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'deletePages', 'type' => '2', 'description' => 'Delete pages', 'group_code' => 'pageManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'editPages', 'type' => '2', 'description' => 'Edit pages', 'group_code' => 'pageManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);
        $this->insert('auth_item', ['name' => 'viewPages', 'type' => '2', 'description' => 'View pages', 'group_code' => 'pageManagement', 'created_at' => '1440180000', 'updated_at' => '1440180000']);

        $this->insert('auth_item_child', ['parent' => 'editPages', 'child' => '/admin/page/default/bulk-activate']);
        $this->insert('auth_item_child', ['parent' => 'editPages', 'child' => '/admin/page/default/bulk-deactivate']);
        $this->insert('auth_item_child', ['parent' => 'deletePages', 'child' => '/admin/page/default/bulk-delete']);
        $this->insert('auth_item_child', ['parent' => 'createPages', 'child' => '/admin/page/default/create']);
        $this->insert('auth_item_child', ['parent' => 'deletePages', 'child' => '/admin/page/default/delete']);
        $this->insert('auth_item_child', ['parent' => 'viewPages', 'child' => '/admin/page/default/grid-page-size']);
        $this->insert('auth_item_child', ['parent' => 'viewPages', 'child' => '/admin/page/default/grid-sort']);
        $this->insert('auth_item_child', ['parent' => 'viewPages', 'child' => '/admin/page/default/index']);
        $this->insert('auth_item_child', ['parent' => 'editPages', 'child' => '/admin/page/default/toggle-attribute']);
        $this->insert('auth_item_child', ['parent' => 'editPages', 'child' => '/admin/page/default/update']);
        $this->insert('auth_item_child', ['parent' => 'viewPages', 'child' => '/admin/page/default/view']);

        $this->insert('auth_item_child', ['parent' => 'createPages', 'child' => 'viewPages']);
        $this->insert('auth_item_child', ['parent' => 'deletePages', 'child' => 'viewPages']);
        $this->insert('auth_item_child', ['parent' => 'editPages', 'child' => 'viewPages']);

        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'createPages']);
        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'accessAllPages']);
        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'deletePages']);
        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'editPages']);
        $this->insert('auth_item_child', ['parent' => 'administrator', 'child' => 'viewPages']);
    }

    public function down()
    {
        $this->delete('auth_item_child', ['parent' => 'administrator', 'child' => 'createPages']);
        $this->delete('auth_item_child', ['parent' => 'administrator', 'child' => 'accessAllPages']);
        $this->delete('auth_item_child', ['parent' => 'administrator', 'child' => 'deletePages']);
        $this->delete('auth_item_child', ['parent' => 'administrator', 'child' => 'editPages']);
        $this->delete('auth_item_child', ['parent' => 'administrator', 'child' => 'viewPages']);

        $this->delete('auth_item_child', ['parent' => 'createPages', 'child' => 'viewPages']);
        $this->delete('auth_item_child', ['parent' => 'deletePages', 'child' => 'viewPages']);
        $this->delete('auth_item_child', ['parent' => 'editPages', 'child' => 'viewPages']);

        $this->delete('auth_item_child', ['parent' => 'editPages', 'child' => '/admin/page/default/bulk-activate']);
        $this->delete('auth_item_child', ['parent' => 'editPages', 'child' => '/admin/page/default/bulk-deactivate']);
        $this->delete('auth_item_child', ['parent' => 'deletePages', 'child' => '/admin/page/default/bulk-delete']);
        $this->delete('auth_item_child', ['parent' => 'createPages', 'child' => '/admin/page/default/create']);
        $this->delete('auth_item_child', ['parent' => 'deletePages', 'child' => '/admin/page/default/delete']);
        $this->delete('auth_item_child', ['parent' => 'viewPages', 'child' => '/admin/page/default/grid-page-size']);
        $this->delete('auth_item_child', ['parent' => 'viewPages', 'child' => '/admin/page/default/grid-sort']);
        $this->delete('auth_item_child', ['parent' => 'viewPages', 'child' => '/admin/page/default/index']);
        $this->delete('auth_item_child', ['parent' => 'editPages', 'child' => '/admin/page/default/toggle-attribute']);
        $this->delete('auth_item_child', ['parent' => 'editPages', 'child' => '/admin/page/default/update']);
        $this->delete('auth_item_child', ['parent' => 'viewPages', 'child' => '/admin/page/default/view']);

        $this->delete('auth_item', ['name' => '/admin/page/*']);
        $this->delete('auth_item', ['name' => '/admin/page/default/*']);
        $this->delete('auth_item', ['name' => '/admin/page/default/bulk-activate']);
        $this->delete('auth_item', ['name' => '/admin/page/default/bulk-deactivate']);
        $this->delete('auth_item', ['name' => '/admin/page/default/bulk-delete']);
        $this->delete('auth_item', ['name' => '/admin/page/default/create']);
        $this->delete('auth_item', ['name' => '/admin/page/default/delete']);
        $this->delete('auth_item', ['name' => '/admin/page/default/grid-page-size']);
        $this->delete('auth_item', ['name' => '/admin/page/default/grid-sort']);
        $this->delete('auth_item', ['name' => '/admin/page/default/index']);
        $this->delete('auth_item', ['name' => '/admin/page/default/toggle-attribute']);
        $this->delete('auth_item', ['name' => '/admin/page/default/update']);
        $this->delete('auth_item', ['name' => '/admin/page/default/view']);

        $this->delete('auth_item', ['name' => 'accessAllPages']);
        $this->delete('auth_item', ['name' => 'createPages']);
        $this->delete('auth_item', ['name' => 'deletePages']);
        $this->delete('auth_item', ['name' => 'editPages']);
        $this->delete('auth_item', ['name' => 'viewPages']);

        $this->delete('auth_item_group', ['code' => 'pageManagement']);
    }
}