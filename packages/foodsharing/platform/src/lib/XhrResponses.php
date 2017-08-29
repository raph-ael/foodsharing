<?php
class XhrResponses
{
	const PERMISSION_DENIED = 'permission_denied';

	public function fail_permissions()
	{
		return XhrResponses::PERMISSION_DENIED;
	}

	public function fail_generic()
	{
		return array( 'status' => 0 );
	}

	public function success()
	{
		return array(
			'status' => 1
		);
	}
}
