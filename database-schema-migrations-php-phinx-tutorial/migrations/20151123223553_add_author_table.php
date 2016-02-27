<?php

use Phinx\Migration\AbstractMigration;

class AddAuthorTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $books_table = $this->table('books');
        $books_table
            ->addColumn('author_id', 'integer')
            ->update();

        $authors_table = $this->table('authors');
        $authors_table
            ->addColumn('first_name', 'string')
            ->addColumn('last_name', 'string')
            ->create();
    }
}
