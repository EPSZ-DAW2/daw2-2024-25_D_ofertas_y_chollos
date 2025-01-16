<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Patrocinadores]].
 *
 * @see Patrocinadores
 */
class PatrocinadoresQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Patrocinadores[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Patrocinadores|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
