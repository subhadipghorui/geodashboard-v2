import * as React from "react";
import Box from "@mui/material/Box";
import { SimpleTreeView } from "@mui/x-tree-view/SimpleTreeView";
import { TreeItem } from "@mui/x-tree-view/TreeItem";
import {
  Accordion,
  AccordionDetails,
  AccordionSummary,
  Card,
  CardContent,
  CardHeader,
  Checkbox,
  FormControlLabel,
  Slider,
  Typography,
} from "@mui/material";
import ExpandMoreIcon from "@mui/icons-material/ExpandMore";
export default function LayerPanelTree() {
  return (
    <Card sx={{ width: "100%", border: "none", boxShadow: "none" }}>
      <CardContent>
        <Box sx={{ mb: 2 }}>
          <Typography variant="h6" noWrap component="div">
            Layer Panel
          </Typography>
        </Box>
        <Box>
          <SimpleTreeView multiSelect checkboxSelection>
            <TreeItem itemId="grid" label="Data Grid">
            <Accordion sx={{ border: "none", boxShadow: "none" }}>
                <AccordionSummary
                  expandIcon={<ExpandMoreIcon />}
                  aria-controls="panel3-content"
                  id="panel3-header"
                  sx={{ margin: 0 }}
                >
                  <FormControlLabel
                    control={<Checkbox defaultChecked />}
                    label="Layer 2"
                  />
                </AccordionSummary>
                <AccordionDetails>
                  <Slider
                    defaultValue={50}
                    aria-label="Default"
                    valueLabelDisplay="auto"
                  />
                </AccordionDetails>
              </Accordion>
              <Accordion sx={{ border: "none", boxShadow: "none" }}>
                <AccordionSummary
                  expandIcon={<ExpandMoreIcon />}
                  aria-controls="panel3-content"
                  id="panel3-header"
                  sx={{ margin: 0 }}
                >
                  <FormControlLabel
                    control={<Checkbox defaultChecked />}
                    label="Layer 2"
                  />
                </AccordionSummary>
                <AccordionDetails>
                  <Slider
                    defaultValue={50}
                    aria-label="Default"
                    valueLabelDisplay="auto"
                  />
                </AccordionDetails>
              </Accordion>
            </TreeItem>
            <TreeItem itemId="pickers" label="Date and Time Pickers">
              <TreeItem
                itemId="pickers-community"
                label="@mui/x-date-pickers"
              />
              <TreeItem itemId="pickers-pro" label="@mui/x-date-pickers-pro" />
            </TreeItem>
            <TreeItem itemId="charts" label="Charts">
              <TreeItem itemId="charts-community" label="@mui/x-charts" />
            </TreeItem>
            <TreeItem itemId="tree-view" label="Tree View">
              <TreeItem itemId="tree-view-community" label="@mui/x-tree-view" />
            </TreeItem>
          </SimpleTreeView>
        </Box>
      </CardContent>
    </Card>
  );
}
