<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Proveedores]].
 *
 * @see Proveedores
 */
class ProveedoresQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Proveedores[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Proveedores|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
