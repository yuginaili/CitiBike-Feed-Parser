<?php

/* sites/all/modules/custom/citi_bike/templates/citi-bike-stations.html.twig */
class __TwigTemplate_c06f679721aa476483fab5b199d50d7e095528befd4c6e2c4cdb4a7d27a7ce9a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $tags = array("for" => 15);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('for'),
                array(),
                array()
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setTemplateFile($this->getTemplateName());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 1
        echo "
<table id=\"citi-bike-stations-container\" class=\"display\" cellspacing=\"0\" width=\"100%\">   
\t<thead>
\t  <tr>
\t  \t<th>Station ID</th>
\t    <th>Station Name</th>
\t    <th>Available Docks</th>
\t    <th>Available Bikes</th>
\t    <th>Last Time Checked</th>
\t  </tr>
\t</thead>

\t<tbody>

\t";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["stations"]) ? $context["stations"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["station"]) {
            // line 16
            echo "
    <tr>
      <td>";
            // line 18
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["station"], "id", array()), "html", null, true));
            echo "</td>
      <td>";
            // line 19
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["station"], "stationName", array()), "html", null, true));
            echo "</td>
      <td>";
            // line 20
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["station"], "availableDocks", array()), "html", null, true));
            echo "</td>
      <td>";
            // line 21
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["station"], "availableBikes", array()), "html", null, true));
            echo "</td>
      <td>";
            // line 22
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["station"], "lastCommunicationTime", array()), "html", null, true));
            echo "</td>
    </tr>

  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['station'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        echo "
  </tbody>

</table>";
    }

    public function getTemplateName()
    {
        return "sites/all/modules/custom/citi_bike/templates/citi-bike-stations.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 26,  83 => 22,  79 => 21,  75 => 20,  71 => 19,  67 => 18,  63 => 16,  59 => 15,  43 => 1,);
    }

    public function getSource()
    {
        return "
<table id=\"citi-bike-stations-container\" class=\"display\" cellspacing=\"0\" width=\"100%\">   
\t<thead>
\t  <tr>
\t  \t<th>Station ID</th>
\t    <th>Station Name</th>
\t    <th>Available Docks</th>
\t    <th>Available Bikes</th>
\t    <th>Last Time Checked</th>
\t  </tr>
\t</thead>

\t<tbody>

\t{% for station in stations %}

    <tr>
      <td>{{ station.id }}</td>
      <td>{{ station.stationName }}</td>
      <td>{{ station.availableDocks }}</td>
      <td>{{ station.availableBikes }}</td>
      <td>{{ station.lastCommunicationTime }}</td>
    </tr>

  {% endfor %}

  </tbody>

</table>";
    }
}
