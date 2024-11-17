import * as React from "react";
import Accordion from "@mui/material/Accordion";
import AccordionActions from "@mui/material/AccordionActions";
import AccordionSummary from "@mui/material/AccordionSummary";
import AccordionDetails from "@mui/material/AccordionDetails";
import ExpandMoreIcon from "@mui/icons-material/ExpandMore";
import Button from "@mui/material/Button";
import { Box, Checkbox, FormControlLabel, Slider } from "@mui/material";

export default function LayerPanel() {
  return (
    <Box sx={{ p: 1}}>
      <Accordion sx={{border: 'none', boxShadow: 'none', margin: 0, p: 0 }}>
        <AccordionSummary
          expandIcon={<ExpandMoreIcon />}
          aria-controls="panel3-content"
          id="panel3-header"
        >
          <FormControlLabel control={<Checkbox defaultChecked />} label="Group Layers" />
        </AccordionSummary>
        <>
        <Accordion sx={{border: 'none', boxShadow: 'none'}}>
          <AccordionSummary
            expandIcon={<ExpandMoreIcon />}
            aria-controls="panel3-content"
            id="panel3-header"
            sx={{margin:0}}
          >
            <FormControlLabel control={<Checkbox defaultChecked />} label="Layer 2" />
          </AccordionSummary>
          <AccordionDetails sx={{margin: 0}}>
            <Slider defaultValue={50} aria-label="Default" valueLabelDisplay="auto" />
            
          </AccordionDetails>
        </Accordion>
        <Accordion sx={{border: 'none', boxShadow: 'none'}}>
          <AccordionSummary
            expandIcon={<ExpandMoreIcon />}
            aria-controls="panel3-content"
            id="panel3-header"
            sx={{margin:0}}
          >
            <FormControlLabel control={<Checkbox defaultChecked />} label="Layer 2" />
          </AccordionSummary>
          <AccordionDetails>
            <Slider defaultValue={50} aria-label="Default" valueLabelDisplay="auto" />
          </AccordionDetails>
        </Accordion>
        </>
      </Accordion>
    </Box>
  );
}
