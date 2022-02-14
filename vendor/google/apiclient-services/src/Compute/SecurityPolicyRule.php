<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\Compute;

class SecurityPolicyRule extends \Google\Model
{
  public $action;
  public $description;
  protected $headerActionType = SecurityPolicyRuleHttpHeaderAction::class;
  protected $headerActionDataType = '';
  public $kind;
  protected $matchType = SecurityPolicyRuleMatcher::class;
  protected $matchDataType = '';
  public $preview;
  public $priority;
  protected $rateLimitOptionsType = SecurityPolicyRuleRateLimitOptions::class;
  protected $rateLimitOptionsDataType = '';
  protected $redirectOptionsType = SecurityPolicyRuleRedirectOptions::class;
  protected $redirectOptionsDataType = '';

  public function setAction($action)
  {
    $this->action = $action;
  }
  public function getAction()
  {
    return $this->action;
  }
  public function setDescription($description)
  {
    $this->description = $description;
  }
  public function getDescription()
  {
    return $this->description;
  }
  /**
   * @param SecurityPolicyRuleHttpHeaderAction
   */
  public function setHeaderAction(SecurityPolicyRuleHttpHeaderAction $headerAction)
  {
    $this->headerAction = $headerAction;
  }
  /**
   * @return SecurityPolicyRuleHttpHeaderAction
   */
  public function getHeaderAction()
  {
    return $this->headerAction;
  }
  public function setKind($kind)
  {
    $this->kind = $kind;
  }
  public function getKind()
  {
    return $this->kind;
  }
  /**
   * @param SecurityPolicyRuleMatcher
   */
  public function setMatch(SecurityPolicyRuleMatcher $match)
  {
    $this->match = $match;
  }
  /**
   * @return SecurityPolicyRuleMatcher
   */
  public function getMatch()
  {
    return $this->match;
  }
  public function setPreview($preview)
  {
    $this->preview = $preview;
  }
  public function getPreview()
  {
    return $this->preview;
  }
  public function setPriority($priority)
  {
    $this->priority = $priority;
  }
  public function getPriority()
  {
    return $this->priority;
  }
  /**
   * @param SecurityPolicyRuleRateLimitOptions
   */
  public function setRateLimitOptions(SecurityPolicyRuleRateLimitOptions $rateLimitOptions)
  {
    $this->rateLimitOptions = $rateLimitOptions;
  }
  /**
   * @return SecurityPolicyRuleRateLimitOptions
   */
  public function getRateLimitOptions()
  {
    return $this->rateLimitOptions;
  }
  /**
   * @param SecurityPolicyRuleRedirectOptions
   */
  public function setRedirectOptions(SecurityPolicyRuleRedirectOptions $redirectOptions)
  {
    $this->redirectOptions = $redirectOptions;
  }
  /**
   * @return SecurityPolicyRuleRedirectOptions
   */
  public function getRedirectOptions()
  {
    return $this->redirectOptions;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(SecurityPolicyRule::class, 'Google_Service_Compute_SecurityPolicyRule');
