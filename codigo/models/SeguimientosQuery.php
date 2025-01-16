<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Seguimientos]].
 *
 * @see Seguimientos
 */
class SeguimientosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Seguimientos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Seguimientos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
