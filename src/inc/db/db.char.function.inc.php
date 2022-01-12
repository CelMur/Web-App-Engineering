<?php

    require_once("db.spell.class.inc.php")

function db_char_createCharacter($con, $cid, $uid, $name, $class, $level){
    $collection = $con->characters;

    $insertOneResult = $collection->insertOne(
        [   
            'cid' => $cid,
            'uid' => $uid,
            'level' => $level,
            'name' => $name,
            'class' => $class           
        ]);

    if(empty($insertOneResult)){
        return false;
    }

    return $cid;
}


function db_char_deleteCharcter($con, $uid, $cid)
{
    $collection = $con->characters;

    $deleteOneResult = $collection->deleteOne(
        [
            'uid' => ['$eq' => $uid], 
            'cid' => ['$eq' => $cid]
        ]
    );

    return $deleteOneResult;
}

function db_char_getSpells($char_id){
    $result = array();
    $col = "characters";
    $collection = $con->$col;
    $filter = ['user_id' => ['$eq' => $user_id]];
    $cursor = $collection->find($filter);
    $spelllist = $cursor=>spells;
    $count = count($cursor);
    $col = "characters";
    $collection = $con->$col;

    foreach($spelllist as $spell){
        $spellfilter = ['']
        $spellcursor = $collection->find()
        $tmpspell = new Spell();
        $tmpspell=>
        

    }

    return null;
}


function db_char_getCharactersByUID($con, $uid)
{
    $result = array();
    $col = "characters";
    $collection = $con->$col;

    $cursor = $collection->find(
        ['uid' => ['$eq' => $uid]],
        [
            '_id' => 0,
            'cid' => 1,
            'uid' => 1,
            'name' => 1,
            'class' => 1,
            'level' => 1
        ]
    );



    foreach ($cursor as $doc) {
        $elmt = new Character();
        $elmt->cid = $doc['cid'];
        $elmt->uid = $doc['uid'];
        $elmt->name = $doc['name'];
        $elmt->class = $doc['class'];
        $elmt->level = $doc['level'];

        $result[] = $elmt;
    }

    return $result;
}


function db_char_updateCharacter($con, $uid, $cid, $name, $class, $level){
    $collection = $con->characters;

    $updateOneResult = $collection->updateOne(
        ['uid'=> ['$eq' => $uid], 'cid' => ['$eq' => $cid]],                        
        ['$set' =>['name' => $name, 'class' => $class, 'level' => $level]]
    );

    if(!isset($updateOneResult)){
        return false;
    }

    return true;
}


function db_char_exists($con, $uid, $cid)
{
    $collection = $con->users;

    $findOneResult = $collection->findOne(
        [
            'uid' => ['$eq' => $uid],
            'cid' => ['$eq' => $cid]
        ]);

    if(empty($findOneResult)) {
        return false;
    }

    return true;
}