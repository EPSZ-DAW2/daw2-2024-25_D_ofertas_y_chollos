<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Incidencia]].
 *
 * @see Incidencia
 */
class IncidenciasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Incidencia[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Incidencia|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
