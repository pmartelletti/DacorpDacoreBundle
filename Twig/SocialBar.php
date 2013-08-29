<?php

namespace Dacorp\CoreBundle\Twig;

class SocialBar extends \Twig_Extension{

    protected $container;

    /**
     * Constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function getName()
    {
        return 'dacorp_social_bar';
    }

    public function getFunctions()
    {
        return array(
            'socialButtons' => new \Twig_Function_Method($this, 'getSocialButtons' ,array('is_safe' => array('html'))),
            'facebookButton' => new \Twig_Function_Method($this, 'getFacebookLikeButton' ,array('is_safe' => array('html'))),
            'twitterButton' => new \Twig_Function_Method($this, 'getTwitterButton' ,array('is_safe' => array('html'))),
            'googlePlusButton' => new \Twig_Function_Method($this, 'getGooglePlusButton' ,array('is_safe' => array('html'))),
            'pinterestButton' => new \Twig_Function_Method($this, 'getPinterestButton' ,array('is_safe' => array('html'))),
        );
    }

    public function getSocialButtons($parameters = array())
    {
        foreach (array('facebook','twitter','googleplus','pinterest') as $buttonType) {
            // no parameters were defined, keeps default values
            if (!array_key_exists($buttonType, $parameters)){
                $render_parameters[$buttonType] = array();
                // parameters are defined, overrides default values
            }else if(is_array($parameters[$buttonType])){
                $render_parameters[$buttonType] = $parameters[$buttonType];
                // the button is not displayed
            }else{
                $render_parameters[$buttonType] = false;
            }

    }



        if ($parameters['url']!=null){
            $render_parameters['facebook']['url']=$parameters['url'];
            $render_parameters['twitter']['url']=$parameters['url'];
            $render_parameters['googleplus']['url']=$parameters['url'];
            $render_parameters['pinterest']['url']=$parameters['url'];
        }

        $render_parameters['pinterest']=false;
        // get the helper service and display the template
        return $this->container->get('dacorp.socialBarHelper')->socialButtons($render_parameters);
    }

    //https://developers.facebook.com/docs/reference/plugins/like/ 
    public function getFacebookLikeButton($parameters = array())
    {
        // default values, you can override the values by setting them
        $parameters = $parameters + array(
            'url' => null,
            'locale' => 'en_US',
            'send' => false,
            'width' => 60,
            'showFaces' => false,
            'layout' => 'box_count',
        );

        return $this->container->get('dacorp.socialBarHelper')->facebookButton($parameters);
    }

    public function getTwitterButton($parameters = array())
    {
        $parameters = $parameters + array(
            'url' => null,
            'locale' => 'en',
            'message' => 'I want to share that page with you',
            'text' => 'Tweet',
            'via' => 'pico.it team',
            'count' => 'vertical',
            'tag' => false,

        );


        return $this->container->get('dacorp.socialBarHelper')->twitterButton($parameters);
    }

    public function getGooglePlusButton($parameters = array())
    {
        $parameters = $parameters + array(
            'url' => null,
            'locale' => 'en',
            'size' => 'tall',
            'annotation' => 'bubble',
            'width' => '60',
        );

        return $this->container->get('dacorp.socialBarHelper')->googlePlusButton($parameters);
    }

    public function getPinterestButton($parameters = array())
    {
        $parameters = $parameters + array(
            'url' => null,
        );

        return $this->container->get('dacorp.socialBarHelper')->pinterestButton($parameters);
    }
}

?>