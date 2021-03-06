<?php
// (c) Copyright 2002-2016 by authors of the Tiki Wiki CMS Groupware Project
//
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: vimeolib.php 57967 2016-03-17 20:06:16Z jonnybradley $

class VimeoLib
{
	private $oauth;

	/**
	 * VimeoLib constructor.
	 * @param OAuthLib $oauthlib
	 */
	function __construct($oauthlib)
	{
		$this->oauth = $oauthlib;
	}

	function isAuthorized()
	{
		return $this->oauth->is_authorized('vimeo');
	}

	/**
	 * Gets array of space and uploads left for the Vimeo account in ['user'] or an error in ['err']
	 *
	 * @return array
	 */
	function getQuota()
	{
		$data = $this->callMethod('vimeo.videos.upload.getQuota');
		return $data;
	}

	/**
	 * Gets an upload ticket in  ['ticket'] or an error in ['err']
	 *
	 * @return array
	 */
	function getTicket()
	{
		$data = $this->callMethod(
			'vimeo.videos.upload.getTicket',
			array(
				'upload_method' => 'post',
			)
		);
		return $data;
	}

	function verifyChunks($ticketId)
	{
		$data = $this->callMethod(
			'vimeo.videos.upload.verifyChunks',
			array(
				'ticket_id' => $ticketId,
			)
		);
		return $data['ticket']['chunks'];
	}

	function complete($ticketId, $fileName)
	{
		$data = $this->callMethod(
			'vimeo.videos.upload.complete',
			array(
				'ticket_id' => $ticketId,
				'filename' => $fileName,
			)
		);
		return $data;
	}

	function setTitle($videoId, $title)
	{
		$data = $this->callMethod(
			'vimeo.videos.setTitle',
			array(
				'video_id' => $videoId,
				'title' => $title,
			)
		);
	}

	function deleteVideo($videoId)
	{
		$data = $this->callMethod(
			'vimeo.videos.delete',
			array(
				'video_id' => $videoId,
			)
		);
		return $data;
	}

	private function callMethod($method, array $arguments = array())
	{
		$response = $this->oauth->do_request(
			'vimeo',
			array(
				'url' => 'https://vimeo.com/api/rest/v2',
				'post' => array_merge(
					$arguments,
					array(
						'method' => $method,
						'format' => 'json',
					)
				),
			)
		);

		return json_decode($response->getBody(), true);
	}
}

