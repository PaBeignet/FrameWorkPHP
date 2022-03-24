<?php
return array("#tableName"=>"order","#primaryKeys"=>["id"=>"id"],"#manyToOne"=>["employee","timeslot","user"],"#fieldNames"=>["id"=>"id","dateCreation"=>"dateCreation","status"=>"status","amount"=>"amount","toPay"=>"toPay","itemsNumber"=>"itemsNumber","missingNumber"=>"missingNumber","employee"=>"idEmployee","orderdetails"=>"orderdetails","timeslot"=>"idTimeslot","user"=>"idUser"],"#memberNames"=>["id"=>"id","dateCreation"=>"dateCreation","status"=>"status","amount"=>"amount","toPay"=>"toPay","itemsNumber"=>"itemsNumber","missingNumber"=>"missingNumber","idEmployee"=>"employee","orderdetails"=>"orderdetails","idTimeslot"=>"timeslot","idUser"=>"user"],"#fieldTypes"=>["id"=>"int(11)","dateCreation"=>"timestamp","status"=>"enum('created','prepared','delivered','')","amount"=>"decimal(6,2)","toPay"=>"decimal(6,2)","itemsNumber"=>"int(11)","missingNumber"=>"int(11)","employee"=>"mixed","orderdetails"=>"mixed","timeslot"=>"mixed","user"=>"mixed"],"#nullable"=>["id","employee","timeslot"],"#notSerializable"=>["employee","orderdetails","timeslot","user"],"#transformers"=>[],"#accessors"=>["id"=>"setId","dateCreation"=>"setDateCreation","status"=>"setStatus","amount"=>"setAmount","toPay"=>"setToPay","itemsNumber"=>"setItemsNumber","missingNumber"=>"setMissingNumber","idEmployee"=>"setEmployee","orderdetails"=>"setOrderdetails","idTimeslot"=>"setTimeslot","idUser"=>"setUser"],"#oneToMany"=>["orderdetails"=>["mappedBy"=>"order","className"=>"models\\Orderdetail"]],"#joinColumn"=>["employee"=>["className"=>"models\\Employee","name"=>"idEmployee","nullable"=>true],"timeslot"=>["className"=>"models\\Timeslot","name"=>"idTimeslot","nullable"=>true],"user"=>["className"=>"models\\User","name"=>"idUser"]],"#invertedJoinColumn"=>["idEmployee"=>["member"=>"employee","className"=>"models\\Employee"],"idTimeslot"=>["member"=>"timeslot","className"=>"models\\Timeslot"],"idUser"=>["member"=>"user","className"=>"models\\User"]]);