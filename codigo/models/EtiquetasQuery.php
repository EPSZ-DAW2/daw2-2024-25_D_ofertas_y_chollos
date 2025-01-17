<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Etiqueta]].
 *
 * @see Etiqueta
 */
class EtiquetasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Etiqueta[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Etiqueta|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * Añade un contador de ofertas a la consulta
     *
     * @return EtiquetasQuery
     */
    public function ofertaCount()
    {
        return $this->select(['etiquetas.*', 'COUNT(ofertas_etiquetas.oferta_id) AS num_ofertas'])
            ->leftJoin('ofertas_etiquetas', 'etiquetas.id = ofertas_etiquetas.etiqueta_id')
            ->groupBy(['etiquetas.id', 'etiquetas.nombre']);
    }
    

}
