<?php

class TarefaService{
    private $conexao;
    private $tarefa;

    public function __construct(Conexao $conexao, Tarefa $tarefa){
        $this->$conexao = $conexao->conectar();
        $this->$tarefa = $tarefa;

    }

    public function inserir(){
        //C - create
        $query = 'insert into tb_tarefas (tarefa)values(:tarefa)';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tarefa', $this->tarefa->get('tarefa'));
        $stmt->execute();
    }


    public function recuperar(){
        //R - read

        $query = '
            select 
                t.id, s.status, t.tarefa
            from
                tb_tarefa as t
                left join_status as s on (t.id_status = s.id) 
        ';

        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}



?>