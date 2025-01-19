<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[EstadosTerminacion]].
 *
 * @see EstadosTerminacion
 */
class EstadosTerminacionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return EstadosTerminacion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EstadosTerminacion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
