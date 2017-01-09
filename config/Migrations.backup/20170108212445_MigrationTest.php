<?php
use Migrations\AbstractMigration;

class MigrationTest extends AbstractMigration
{

    public function up()
    {

        $this->table('access_roles')
            ->changeColumn('name', 'string')
            ->changeColumn('description', 'text')
            ->update();

        $this->table('access_status')
            ->changeColumn('status', 'string')
            ->update();

        $this->table('companies')
            ->changeColumn('name', 'string')
            ->changeColumn('email', 'string')
            ->changeColumn('address', 'string')
            ->changeColumn('contact', 'string')
            ->changeColumn('description', 'text')
            ->update();

        $this->table('doors')
            ->changeColumn('name', 'string')
            ->changeColumn('location', 'string')
            ->changeColumn('description', 'text')
            ->update();

        $this->table('enclosures')
            ->changeColumn('name', 'string')
            ->changeColumn('description', 'text')
            ->changeColumn('location', 'string')
            ->update();

        $this->table('forms')
            ->changeColumn('name', 'string')
            ->changeColumn('description', 'text')
            ->update();

        $this->table('people')
            ->changeColumn('rut', 'string')
            ->changeColumn('name', 'string')
            ->changeColumn('lastname', 'string')
            ->update();

        $this->table('profiles')
            ->changeColumn('name', 'string')
            ->update();

        $this->table('reason_visits')
            ->changeColumn('reason', 'string')
            ->update();

        $this->table('sensor_data')
            ->changeColumn('data', 'string')
            ->update();

        $this->table('sensor_types')
            ->changeColumn('name', 'string')
            ->changeColumn('model', 'string')
            ->changeColumn('description', 'text')
            ->update();

        $this->table('sensors')
            ->changeColumn('code', 'string')
            ->update();

        $this->table('user_roles')
            ->changeColumn('role', 'string')
            ->changeColumn('description', 'text')
            ->update();

        $this->table('users')
            ->changeColumn('username', 'string')
            ->changeColumn('password', 'string')
            ->update();

        $this->table('vehicle_authorizations')
            ->changeColumn('vehicle_id', 'string')
            ->update();

        $this->table('vehicle_profiles')
            ->changeColumn('name', 'string')
            ->update();

        $this->table('vehicle_types')
            ->changeColumn('type', 'string')
            ->update();

        $this->table('vehicles')
            ->changeColumn('number_plate', 'string')
            ->update();

        $this->table('visit_profiles')
            ->changeColumn('note', 'text')
            ->update();
    }

    public function down()
    {

        $this->table('access_roles')
            ->changeColumn('name', 'string', [
                'default' => null,
                'length' => 50,
                'null' => false,
            ])
            ->changeColumn('description', 'text', [
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->update();

        $this->table('access_status')
            ->changeColumn('status', 'string', [
                'default' => null,
                'length' => 50,
                'null' => false,
            ])
            ->update();

        $this->table('companies')
            ->changeColumn('name', 'string', [
                'default' => null,
                'length' => 50,
                'null' => false,
            ])
            ->changeColumn('email', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('address', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('contact', 'string', [
                'default' => null,
                'length' => 150,
                'null' => false,
            ])
            ->changeColumn('description', 'text', [
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->update();

        $this->table('doors')
            ->changeColumn('name', 'string', [
                'default' => null,
                'length' => 150,
                'null' => false,
            ])
            ->changeColumn('location', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('description', 'text', [
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->update();

        $this->table('enclosures')
            ->changeColumn('name', 'string', [
                'default' => null,
                'length' => 150,
                'null' => false,
            ])
            ->changeColumn('description', 'text', [
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->changeColumn('location', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->update();

        $this->table('forms')
            ->changeColumn('name', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->changeColumn('description', 'text', [
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->update();

        $this->table('people')
            ->changeColumn('rut', 'string', [
                'default' => null,
                'length' => 50,
                'null' => false,
            ])
            ->changeColumn('name', 'string', [
                'default' => null,
                'length' => 50,
                'null' => false,
            ])
            ->changeColumn('lastname', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->update();

        $this->table('profiles')
            ->changeColumn('name', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->update();

        $this->table('reason_visits')
            ->changeColumn('reason', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->update();

        $this->table('sensor_data')
            ->changeColumn('data', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->update();

        $this->table('sensor_types')
            ->changeColumn('name', 'string', [
                'default' => null,
                'length' => 150,
                'null' => false,
            ])
            ->changeColumn('model', 'string', [
                'default' => null,
                'length' => 150,
                'null' => false,
            ])
            ->changeColumn('description', 'text', [
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->update();

        $this->table('sensors')
            ->changeColumn('code', 'string', [
                'default' => null,
                'length' => 50,
                'null' => false,
            ])
            ->update();

        $this->table('user_roles')
            ->changeColumn('role', 'string', [
                'default' => null,
                'length' => 50,
                'null' => false,
            ])
            ->changeColumn('description', 'text', [
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->update();

        $this->table('users')
            ->changeColumn('username', 'string', [
                'default' => null,
                'length' => 50,
                'null' => false,
            ])
            ->changeColumn('password', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->update();

        $this->table('vehicle_authorizations')
            ->changeColumn('vehicle_id', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->update();

        $this->table('vehicle_profiles')
            ->changeColumn('name', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->update();

        $this->table('vehicle_types')
            ->changeColumn('type', 'string', [
                'default' => null,
                'length' => 255,
                'null' => false,
            ])
            ->update();

        $this->table('vehicles')
            ->changeColumn('number_plate', 'string', [
                'default' => null,
                'length' => 15,
                'null' => false,
            ])
            ->update();

        $this->table('visit_profiles')
            ->changeColumn('note', 'text', [
                'default' => null,
                'length' => null,
                'null' => false,
            ])
            ->update();
    }
}

