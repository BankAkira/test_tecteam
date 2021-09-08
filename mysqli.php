<?php
function pare_mysqli_close($stmt)
{
	if ($stmt)
	{
		if (isset($stmt->result))
		{
			$stmt->result->close();
		}
		$stmt->close();
	}
}

function pare_mysqli_fetch_array($stmt, $resulttype)
{
	return (isset($stmt->result) ? $stmt->result->fetch_array($resulttype) : $stmt->fetch_array($resulttype));
}

function pare_mysqli_num_rows($stmt)
{
	return (isset($stmt->result) ? $stmt->result->num_rows : $stmt->num_rows);
}

function pare_mysqli_prepare($mysqli, $query, $types, ...$var)
{
	if (strlen($types))
	{
		$stmt = $mysqli->prepare($query);
		if ($types)
		{
			$bind_len = strlen($types);
			$bind_var = '$stmt->bind_param($types';
			for ($i = 0; $i < $bind_len; $i++)
			{
				$par[$i] = $mysqli->real_escape_string($var[$i]);
				$bind_var .= ',$var['.$i.']';
			}
			$bind_var .= ');';
			eval($bind_var);
		}
		if ($stmt->execute())
		{
			if (preg_match('/SELECT/is', $query))
			{
				$stmt->result = $stmt->get_result();
			}
		}
		else
		{
			$stmt->close();
			return false;
		}
	}
	else
	{
		$stmt = $mysqli->query($query);
	}
	return $stmt;
}

function pare_mysqli_prepare_and_close($mysqli, $query, $types, ...$var)
{
	$result = pare_mysqli_prepare($mysqli, $query, $types, ...$var);
	if (!$result)
	{
		return false;
	}
	pare_mysqli_close($result);
	return true;
}
?>