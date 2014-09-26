<?php

namespace Omnipay\Stripe\Message;

/**
 * Stripe Create Credit Card Request
 */
class CreateCardRequest extends AbstractRequest
{
    public function getData()
    {
        $data = array();
        $data['description'] = $this->getDescription();

        if ($this->getToken()) {
            $data['card'] = $this->getToken();
        } elseif ($this->getCard()) {
            $data['card'] = $this->getCardData();
            $data['email'] = $this->getCard()->getEmail();
        } else {
            // one of token or card is required
            $this->validate('card');
        }

		if ($this->getEmail()) {
			$data['email'] = $this->getEmail();
		}
		if ($this->getMetadata()) {
			$data['metadata'] = $this->getMetadata();
		}

        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint.'/customers';
    }

	public function getEmail()
	{
		return $this->getParameter('email');
	}

	public function setEmail($value)
	{
		return $this->setParameter('email', $value);
	}
}
