<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\FuncionariosRepository;
use Dompdf\Dompdf;
use PHPExcel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

require __DIR__ . '/../../vendor/autoload.php';

class RelatorioController extends AbstractController
{
    /**
     * @Route("/relatorio", name="relatorio_index")
     * @Template("relatorio/index.html.twig")
     */
    public function index()
    {
        return $this->render('relatorio/index.html.twig', [
            'controller_name' => 'RelatorioController',
        ]);
    }

   /**
    * @param Request $request
    *
    * @Route("/relatorio/funcionario", name="relatorio_funcionario")
    * @return Response
    */
    public function relatorioFuncionario(Request $request, FuncionariosRepository $funcionarioRepository)
    {
        $funcionarios = [];
        $form = $this->createFormBuilder()
            ->add('data_inicio', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('data_fim', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('status', ChoiceType::class, array(
                'choices'  => array(
                    'Ativo'    =>1,
                    'Inativo' =>0
                )))
           /* ->add('tipo', ChoiceType::class, array(
                'choices'  => array(
                    'Estatutário'    =>'Estatutário',
                    'Comissionado' =>'Comissionado',
                    'Nenhum' => ''
                )))*/
            ->add('pdf', SubmitType::class, [
                'label' => 'Gerar PDF'
            ])
            ->add('pesquisar', SubmitType::class, [
                'label' => 'Pesquisar'
            ])
            // ->add('excel', SubmitType::class, [
            //     'label' => 'Gerar Excel'
            // ])
            ->getForm();
            
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $funcionarios = $funcionarioRepository->getFuncionarioAtivoPorData(
                $data['data_inicio'],
                $data['data_fim'],
                $data['status']
               // $data['tipo']
            );
            //dump($funcionarios);
            $pdfClicked = $form->get('pdf')->isClicked();
            if ($pdfClicked) {
                return $this->funcionarioPdf($funcionarios);
            }
            // $excelClicked = $form->get('excel')->isClicked();
            // if ($excelClicked) {
            //     $excel = $this->funcionarioExcel($funcionarios);
            //     return new Response(
            //         $excel, 200, array (
            //         'Content-Type' => 'application/vnd.ms-excel',
            //         'Content-Disposition' => 'attachment; filename="Relatório_Funcionários.xlsx"',
            //     )
            //     );
            // }
        }
        return $this->render('relatorio/funcionarioRel.html.twig', [
            'funcionarios' => $funcionarios,
            'form' => $form->createView()
        ]);
    }

    private function funcionarioPdf($funcionarios)
    {
        $view = $this->renderView('relatorio/funcionarioPdf.html.twig', [
           'funcionarios' =>  $funcionarios
        ]);
        $domPdf = new Dompdf();
        $domPdf->loadHtml($view);
        $domPdf->setPaper('A4','portrait');
        $domPdf->render();
        return $domPdf->stream('Relatório_Funcionários');
    }

    /**
     * @Route("/relatorio/funcionario_excel", name="funcionario_excel")
     */
    public function funcionarioExcel($funcionarios)
    {
        $excel = new PHPExcel();
        $total = $funcionarios;
        $excel->setActiveSheetIndex(0)
            ->setCellValue( 'A1', 'Mat.')
            ->setCellValue( 'B1', 'Nome')
            ->setCellValue( 'C1', 'Cargo')
            ->setCellValue( 'D1', 'Status')
            ->setCellValue( 'E1', 'Data Admissão')
            ->setCellValue( 'F1', 'Data Exoneração')
            ->setCellValue( 'G1', 'Remuneração');
        $contador = 1;
        foreach ($total as $linha) {
            $contador++;
            $excel->setActiveSheetIndex(0)->setCellValue('A'.$contador, $linha->getId());
            $excel->setActiveSheetIndex(0)->setCellValue('B'.$contador, $linha->getNome());
            $excel->setActiveSheetIndex(0)->setCellValue('C'.$contador, $linha->getTipo());
            $excel->setActiveSheetIndex(0)->setCellValue('D'.$contador, $linha->getStatus());
           // $excel->setActiveSheetIndex(0)->setCellValue('E'.$contador, $linha->getAdmissao());
           // $excel->setActiveSheetIndex(0)->setCellValue('F'.$contador, $linha->getExoneracao());
            //$excel->setActiveSheetIndex(0)->setCellValue('G'.$contador, $linha->getRemuneracao()->getPagamento());
        }
        /*header('Content-Type: application/vnd.openxmlformarts-officedocument.spreadsheetml.sheet ');
        header('Content-Disposition: attachment; filename="Relatório_Funcionários.xlsx"');
        header('Cache-Control: max-age=0');*/
        $file = \PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        ob_start();
        $file->save('php://output');
        return ob_get_clean();
    }

     /**
     * @param Request $request
     *
     * @Route("/relatorio/secretaria",name="relatorio_secretaria")
     * @Template("relatorio/secretariaRel.html.twig")
     * @return Response
     */
    public function relatorioSecretaria(Request $request, FuncionariosRepository $funcionarioRepository)
    {
        return $this->render(
            'relatorio/secretariaRel.html.twig',
            ['totalSalarios' => $funcionarioRepository->salarioTotal()]
        );
    }

    /**
     * @param Request $request
     *
     * @Route("/relatorio/grafico",name="relatorio_grafico")
     * @Template("relatorio/graficoSalario.html.twig")
     * @return Response
     */
    public function graficoSalario(Request $request, FuncionariosRepository $funcionarioRepository)
    {
        return $this->render(
            'relatorio/dashboard.html.twig',
            ['totalSalarios' => $funcionarioRepository->salarioTotal()]
        );
    }
 
}
