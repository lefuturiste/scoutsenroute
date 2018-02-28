<?php


use Phinx\Migration\AbstractMigration;

class CreateBlogTablesMigration extends AbstractMigration
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
		$this->table('posts')
			->addColumn('title', 'string')
			->addColumn('content', 'text')
			->addColumn('thumb_url', 'string', [
				'null' => true
			])
			->addColumn('user_id', 'string', [
				'null' => true
			])
			->addColumn('created_at', 'datetime', [
				'null' => true
			])
			->addColumn('updated_at', 'datetime', [
				'null' => true
			])
			->create();

		$this->table('posts')
			->changeColumn('id', 'string')
			->update();

		$this->table('users')
			->addColumn('avatar_url', 'string', [
				'null' => true
			])
			->addColumn('username', 'string', [
				'null' => true
			])
			->addColumn('full_name', 'string', [
				'null' => true
			])
			->addColumn('created_at', 'datetime', [
				'null' => true
			])
			->addColumn('updated_at', 'datetime', [
				'null' => true
			])
			->create();

		$this->table('users')
			->changeColumn('id', 'string')
			->update();
    }
}
