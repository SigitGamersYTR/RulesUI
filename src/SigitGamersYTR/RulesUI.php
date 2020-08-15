<?php

namespace SigitGamersYTR;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;

use pocketmine\utils\TextFormat as C;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;

class RulesUI extends PluginBase implements Listener {
	
   public function onEnable(){
       $this->getLogger()->info(C::GREEN . "RulesUI by SigitGamers Aktif!");
       
       @mkdir($this->getDataFolder());
       $this->saveDefaultConfig();
       $this->getResource("config.yml");
   }

   public function onDisable(){
       $this->getLogger()->info(C::RED . "RulesUI by SigitGamers Mati!");
   }

   public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool {
       switch($cmd->getName()) {
             case "rules":
                 if($sender instanceof Player) {
                    $this->openRulesUI($sender);
                    return true;
                 }
       }
       return true;
   }
   
   public function openRulesUI($sender){
   	$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
       $form = $api->createSimpleForm(function (Player $sender, int $data = null) {
           $result = $data;
           if($result === null){
               return true;
           }             
           switch($result){
               case 0:
               break;
               }
           });
           $form->setTitle($this->getConfig()->get("Rules-Title"));
           $form->setContent($this->getConfig()->get("Rules-info"));
           $form->addButton($this->getConfig()->get("Kembali"));
           $form->sendToPlayer($sender);
           return $form;
   }
}
