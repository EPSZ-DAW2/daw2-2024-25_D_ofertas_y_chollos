<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[OfertaEtiqueta]].
 *
 * @see OfertaEtiqueta
 */
class OfertasEtiquetasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OfertaEtiqueta[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OfertaEtiqueta|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
