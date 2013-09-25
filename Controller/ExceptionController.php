<?php

namespace Dacorp\CoreBundle\Controller;

use Symfony\Bundle\TwigBundle\Controller\ExceptionController as BaseExceptionController;
use Symfony\Bundle\FrameworkBundle\Templating\TemplateReference;
use Symfony\Component\HttpKernel\Exception\FlattenException;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ExceptionController extends BaseExceptionController
{


    /**
     * Converts an Exception to a Response.
     *
     * @param Request              $request   The request
     * @param FlattenException     $exception A FlattenException instance
     * @param DebugLoggerInterface $logger    A DebugLoggerInterface instance
     * @param string               $format    The format to use for rendering (html, xml, ...)
     *
     * @return Response
     *
     * @throws \InvalidArgumentException When the exception template does not exist
     */
    public function showAction(Request $request, FlattenException $exception, DebugLoggerInterface $logger = null, $_format = 'html')
    {
        $request->setRequestFormat($format);

        $currentContent = $this->getAndCleanOutputBuffering($request->headers->get('X-Php-Ob-Level', -1));

        $code = $exception->getStatusCode();

        return new Response($this->twig->render(
            $this->findTemplate($request, $format, $code, $this->debug),
            array(
                'status_code'    => $code,
                'status_text'    => isset(Response::$statusTexts[$code]) ? Response::$statusTexts[$code] : '',
                'exception'      => $exception,
                'logger'         => $logger,
                'currentContent' => $currentContent,
            )
        ));
    }


    public function show2Action(Request $request, FlattenException $exception, DebugLoggerInterface $logger = null, $format = 'html')
    {
        $kernel = $this->container->get('kernel');
        if ($kernel->getEnvironment() == 'prod' || $kernel->getEnvironment() == 'test'||$kernel->getEnvironment() == 'dev') {
            $request = $this->container->get('request');
            $request->setRequestFormat($format);

            $templating = $this->container->get('templating');
            $code = $exception->getStatusCode();

            $template = new TemplateReference('DacorpCoreBundle', 'Exception', 'errorpage', $format, 'twig');
            if ($templating->exists($template)) {
                $response = $templating->renderResponse($template, array(
                    'status_code' => $code,
                    'message_code' => 'error.message-for-error' . $code,
                    'status_text' => Response::$statusTexts[$code],
                    'requested_url' => $request->getUri(),
                    ));

                $response->setStatusCode($code);
                $response->headers->replace($exception->getHeaders());

                return $response;
            } 
        }
        return parent::showAction($request,$exception, $logger, $format);
    }

}
