#include "FPToolkit.c"
#include <stdio.h>

double total_error(double ** set, double m, double* click){
int i;
double totalerror=0;
for (i=1; i<=sizeof(set); i++){
totalerror += (m*click[0]+click[1])- set[i-1][1];
}
}

int main() {
char filename[100];
printf("input filename: ");
scanf("%s", filename);
G_init_graphics(1000,1000);
G_clear();
G_rgb(1,1,1);
FILE *file;
file = fopen(filename, "r");
char data[100][100];
//data[100 lines][100 characters each]
if(file != NULL) {
int i=0, j=0;
while(fgets(data[i], 100, file)){
i++;
}
} else {
printf("Can't open file.");
}
fclose(file);

//go through array of strings and convert to doubles
int numpoints = atoi(data[0]);
double points[numpoints][2];
int i;
for(i=1; i<=numpoints; i++){
//printf("%s", data[i]);
sscanf(data[i], "%lf   %lf", &points[i-1][0], &points[i-1][1]);
printf("%lf ", points[i-1][0]);
printf("%lf \n", points[i-1][1]);
};

G_rgb(0, 1, 0);
for(i=0; i<numpoints; i++){
G_fill_circle(points[i][0], points[i][1], 2);

};

G_rgb(1, 1, 0);
double input[2];
G_wait_click(input);
G_fill_circle(input[0], input[1], 4);


//give a value for m. find errors, square them, and add them together.
//if total error is decreased by new m, increment or decrement m.
double d=1;

for(d=0; d<180; d++){
total_error(points, d, input);
}



G_wait_key();
}

