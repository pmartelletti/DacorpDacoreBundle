<?php


namespace Dacorp\CoreBundle\Controller;

/*
 * Controller managing the ajax requests
 */
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AjaxController extends Controller
{
    public function uploadAction()
    {
        $editId = $this->getRequest()->get('editId');
        // @TODO, check its a editId of the form defined in FileManager
        $this->get('punk_ave.file_uploader')->handleFileUpload(array('folder' => 'tmp/attachments/' . $editId));
    }
    public function rateAction()
    {
        $this->get('dacorp.stats_manager')->updateStat($this->getRequest()->get('id'),'rate',$this->getRequest()->get('score'));
        return $this->returnJsonResponse('success', $this->get('translator')->trans('flash.message.rating-done'));
    }
    public function voteAction()
    {
        $this->get('dacorp.stats_manager')->updateStat($this->getRequest()->get('id'),$this->getRequest()->get('type'));
        return $this->returnJsonResponse('success', $this->get('translator')->trans('flash.message.voting-done'));
    }



    protected function returnJsonResponse($status,$flashmsg,$content=null)
    {
        $response = new Response(json_encode(array('error' => $status,'flashmsg'=>$flashmsg,'content'=>json_encode($content))));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
