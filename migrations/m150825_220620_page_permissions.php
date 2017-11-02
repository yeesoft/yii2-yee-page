<?php

use yeesoft\db\PermissionsMigration;

class m150825_220620_page_permissions extends PermissionsMigration
{

    public function safeUp()
    {
        $this->addPermissionsGroup('page-management', 'Page Management');
        
        $this->addModel('page', 'Page', yeesoft\page\models\Page::class);
                
        parent::safeUp();
    }

    public function safeDown()
    {
        parent::safeDown();
        $this->deletePermissionsGroup('page-management');
    }

    public function getPermissions()
    {
        return [
            'page-management' => [
                'view-pages' => [
                    'title' => 'View Pages',
                    'roles' => [self::ROLE_ADMIN],
                    'routes' => [
                        ['bundle' => self::ADMIN_BUNDLE, 'controller' => 'page/default', 'action' => 'index'],
                        ['bundle' => self::ADMIN_BUNDLE, 'controller' => 'page/default', 'action' => 'view'],
                        ['bundle' => self::ADMIN_BUNDLE, 'controller' => 'page/default', 'action' => 'grid-sort'],
                        ['bundle' => self::ADMIN_BUNDLE, 'controller' => 'page/default', 'action' => 'grid-page-size'],
                    ],
                ],
                'update-pages' => [
                    'title' => 'Update Pages',
                    'child' => ['view-pages'],
                    'roles' => [self::ROLE_ADMIN],
                    'routes' => [
                        ['bundle' => self::ADMIN_BUNDLE, 'controller' => 'page/default', 'action' => 'update'],
                        ['bundle' => self::ADMIN_BUNDLE, 'controller' => 'page/default', 'action' => 'bulk-activate'],
                        ['bundle' => self::ADMIN_BUNDLE, 'controller' => 'page/default', 'action' => 'bulk-deactivate'],
                        ['bundle' => self::ADMIN_BUNDLE, 'controller' => 'page/default', 'action' => 'toggle-attribute'],
                    ],
                ],
                'create-pages' => [
                    'title' => 'Create Pages',
                    'child' => ['view-pages'],
                    'roles' => [self::ROLE_ADMIN],
                    'routes' => [
                        ['bundle' => self::ADMIN_BUNDLE, 'controller' => 'page/default', 'action' => 'create'],
                    ],
                ],
                'delete-pages' => [
                    'title' => 'Delete Pages',
                    'child' => ['view-pages'],
                    'roles' => [self::ROLE_ADMIN],
                    'routes' => [
                        ['bundle' => self::ADMIN_BUNDLE, 'controller' => 'page/default', 'action' => 'delete'],
                        ['bundle' => self::ADMIN_BUNDLE, 'controller' => 'page/default', 'action' => 'bulk-delete'],
                    ],
                ],
            ],
        ];
    }

}
