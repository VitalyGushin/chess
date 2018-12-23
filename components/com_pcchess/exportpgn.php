<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once('include.pcchess.php');

function ExportGame() {
	$request = JRequest::get( '_REQUEST');
	$game_info = pcc_GetInfoForOneGame($request['game_id']);
	$move_list = pcc_GetGameMoveList($game_info->game_id, 10000, 1);

	if (empty($game_info)) {
		$pgn_output = "Game could not be found.";
	} elseif (empty($move_list)) {
		$pgn_output = "Moves could not be found.";
	} else {
		#header("Content-Type: application/x-chess-pgn");
		#header('Content-Disposition: attachment; filename="' . pcc_GetFileName($game_info) . '.pgn"');
		$pgn_output ="<pre>";
		$pgn_output .= "[Event \"Chess Tournament\"]\n";
		$pgn_output .= "[Site \"" . JUri::base() . "\"]\n";
		$pgn_output .= "[Date \"" . date('Y.m.d',  strtotime($game_info->start)) . "\"]\n";
		$pgn_output .= "[Round \"?\"]\n";
		$pgn_output .= "[White \"" .  pcc_AwaitingChallengerName($game_info->white_username) . "\"]\n";
		$pgn_output .= "[Black \"" .  pcc_AwaitingChallengerName($game_info->black_username) . "\"]\n";

		$game_result = pcc_GetPGNResult($game_info);

		$pgn_output .= "[Result \"" . $game_result . "\"]\n\n";
		set_first_Position();
		foreach ($move_list as $row) {
			$Notation .= $row->move;
			if (!add_Move($row->move)) {
				header("Content-Type: text/plain");
				$pgn_output = "There was an error reading the list of moves.";
				$Notation = '';
				break;
			} else {
				if (!empty($row->comment)) {
					// $Notation .= "{ " . trim($row->comment) . " } ";
					$Notation .= " "; // The comments should be visible on export PGN [TANASE]
				}
				if ($row->color == 1) {
					$Notation .= "\n";
				} else {
					$Notation .= " "; // blank space from white and black moves [TANASE]
				}
			}
		}
		if (!empty($Notation)) {
			$pgn_output .= $Notation . (($game_result == '*') ? '' : $game_result);
		}
	}
	$pgn_output .= "</pre>";
	echo $pgn_output;
}


function pcc_GetFileName($game_info) {
	return pcc_AwaitingChallengerName(ereg_replace("[^A-Za-z0-9]", "", str_replace(" ", "_", $game_info->white_username))) . '_v_' .
	 str_replace(" ", "_", pcc_AwaitingChallengerName(ereg_replace("[^A-Za-z0-9]", "", $game_info->black_username))) .
	 date('_Y_m_d',  strtotime($game_info->start));
}

function pcc_GetPGNResult($game_info) {
	if ($game_info->complete == 2) {
		return '*';
	} elseif ($game_info->complete == 3) {
		// awaiting acceptance from black
		return '*';
	} elseif ($game_info->complete == 4) {
		// awaiting acceptance from white
		return '*';
	} elseif ($game_info->complete == 5) {
		// awaiting acceptance from white
		return '*';
	} elseif ($game_info->draw_offered == 1) {
		return '*';
	} elseif ($game_info->complete == 0) {
		return '*';
	} else {
		if ($game_info->result == 0) {
			return "1-0";
		} elseif ($game_info->result == 1) {
			return "0-1";
		} elseif ($game_info->result == 2) {
			return "1/2-1/2";
		} elseif ($game_info->result == 3) {
			return "1/2-1/2";
		} elseif ($game_info->result == 4) {
			return "0-1";
		} elseif ($game_info->result == 5) {
			return "1-0";
		} else {
			return '*';
		}
	}
}
?>