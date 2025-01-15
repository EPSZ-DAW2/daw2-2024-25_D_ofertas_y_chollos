<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Comentarios]].
 *
 * @see Comentarios
 */
class ComentariosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Comentarios[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Comentarios|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
